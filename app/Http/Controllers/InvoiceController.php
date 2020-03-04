<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Client;
use App\Invoice;
use App\Item;
use App\Credit;
use App\Payment;
use App\Transaction;
use App\MailModel;
use App\Events\MailEvent;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Validator;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function index($status)
    {   
        $invoice  = Invoice::with('client')->where('status', '=', $status)->get();
        return view('invoice.list_invoice', ['invoice' => $invoice]);
    }

    public function add_invoice($id){
        return view('invoice.add_invoice', ['userid'=>$id]);
    }

    public function client_inv_detail($id)
    {   
        $data['client'] = Client::where('clientid', '=', $id)->get();
        $data['date']   = date('Y-m-d');
        $data['duedate'] = config('help.DUE_DATE');

        return response()->json($data, 200);
    }

    public function create(Request $request)
    {
            $total = $request->amount;
            $inv = new Invoice;
            $inv->userid        = $request->userid;
            $inv->status        = "Draft";
            $inv->paymentmethod = $request->paymentmethod;
            $inv->draft         = 1;
            $inv->sendInvoice   = 0;
            $inv->date          = $request->date;
            $inv->duedate       = $request->duedate;
            $inv->taxrate       = config('help.TAXRATE');
            $inv->notes         = $request->notes;
            if($request->taxed == "taxed" && $request->amount != null){
                $total = (float)$request->amount;
                $total *= config('help.PERCENTAGE');
            }
            $inv->total         = $total;
            if($inv->save() && ($request->description != null || $request->amount != null)){
                $inv_id = $inv->invoiceid;
                $item = new Item;
                $item->invoiceid        = $inv_id;
                $item->itemdescription  = $request->description;
                $item->itemamount       = (float)$request->amount;
                if($request->taxed == "taxed"){$item->itemtaxed = 1;}
                $item->save();
            }
        return response()->json(['status'=> 'success', 'last_insert_id'=>$inv->invoiceid], 200);
    }

    public function detail_invoice($id){
        $invoice  = Invoice::with('client')->with('items')->with('credit')->with('payment')->with('transaction')
                                            ->where('tblinvoice.invoiceid', '=', $id)->first();
        return response()->json(["status" => "success", 'invoice'=>$invoice], 200);
    }

    public function update(Request $request)
    {
        $total = 0;
        $id = $request->invoiceid;
        $res = Item::where('invoiceid','=', $request->invoiceid)->delete();
        $update = Invoice::find($id)
                        ->update([
                            'paymentmethod' => $request->paymentmethod,
                            'notes'         => $request->notes,
                            'total'         => $total
                        ]);
        if($update) {
            $item = array();
                foreach ($request->item['amount'] as $i => $value) {
                    if ($request->item['amount'][$i] != "" || $request->item['description'][$i] != "") {
                        $item['invoiceid']          = $id;
                        $item['itemdescription']    = $request->item['description'][$i];
                        $item['itemamount']         = $request->item['amount'][$i];
                        $item['itemtaxed']          = 0;    
                        $amount = (float)$request->item['amount'][$i];
                        if($request->item['taxed'][$i] == "taxed"){
                            $amount *= config('help.PERCENTAGE');
                            $item['itemtaxed']      = 1;
                        }
                        $total = $total + $amount;
                        Item::insert($item);
                    }
                }
                if($request->credit_b != ""){
                    $total = $total - (float)$request->credit_b;
                }
                $invoice = Invoice::find($id)->update(['total' => $total]);
            return response()->json(['status'=>'success', 'message'=>"Invoice has been Updated Successfully"], 200);
        } else {
            return response()->json(['status'=>"failed", 'message'=>"Error while updating data"], 500);
        }   
        return response()->json($request->item, 200);
    }

    public function delete_item(Request $request){
        $id = $request->id;
        $item = Item::find($id);
        if($item->itemtaxed == 1){
            $amount = $item->itemamount;
            $amount *= config('help.PERCENTAGE');
        }else{
            $amount = $item->itemamount;
        }

        $inv_id     = $request->inv_id;
        $invoice    = Invoice::find($inv_id);
        $total = $invoice->total - $amount;
        $invoice = Invoice::find($inv_id)->update(['total' => $total]);
        if($item->delete()){
            return response()->json(['status'=>"success"], 200);
        }else{
            return response()->json(['status'=>"error"], 500);
        }
    }

    public function delete_invoice($id)
    {
        $item       = Item::where('invoiceid', $id);
        $invoice    = Invoice::find($id);
        $client     = Client::find($invoice->userid);
        $credit     = Credit::where('invoiceid', $id)->get();
        $payment    = Payment::where('invoiceid', $id);
            if($credit->count()!=0){
                $amount = $credit[0]->amount;
                $crd    = (float)$client->credit + (float)$amount;
                $client = Client::find($invoice->userid)->update(['credit'=>$crd]);
            }
            $credit = Credit::where('invoiceid', $id);
            if(!empty($item)){
                $item->delete();
                if(!empty($credit) || !empty($payment)){
                    $credit->delete();
                    $payment->delete();
                }    
            }
            if ($invoice->delete()) {
                return response()->json(['status' => 'success', 'message' => 'Invoice has been deleted'], 200);
            } else {
                return response()->json(['status' => "error", 'message'=> 'Failed to delete this data'], 500);
            }
    }

    public function publish_invoice($id)
    {
        $invoice = Invoice::find($id);
        $update = $invoice->update([
                                    'status'        => 'Unpaid',
                                    'sendinvoice'   => 1,
                                    'published_at'  => Carbon::now()->toDateTimeString()
                                ]);
        if ($update) {
            $response = ['status' => 'success', 'message'=>'Invoice created has been published', 'invoiceid'=>$id];
        }else{
            $response = ['status' => 'failed', 'message' => 'Failed to publish Invoice', 'invoiceid'=>$id];
        }
        event(new MailEvent(\App\Client::find($invoice->userid),$response));
        return response()->json($response, 200);
    }

    public function add_credit(Request $request)
    {
        $cek = Credit::where('userid', $request->clientid)->where('invoiceid', $request->id_invoice)->get();
        $credit = new Credit;
        $credit->userid     = $request->clientid;
        $credit->invoiceid  = $request->id_invoice;
        $credit->amount     = $request->add_credit;
        $credit->type       = "Add";
        $credit->date       = Carbon::now()->toDateTimeString();
        $credit->adminid    = $request->session()->get('user_id');
        if($request->c_balance_client < $request->add_credit){
            return response()->json(['status' => 'failed', 'message'=> "You can't apply credit more than credit client"],200);
        }
        $invoice = Invoice::find($request->id_invoice);
        $client = Client::find($request->clientid);
        $payment_method = $invoice->paymentmethod;
        if($request->payment_paymentmethod != null){
            $payment_method = $request->payment_paymentmethod;
        }
        if($invoice->status == "Draft"){
            return response()->json(['status'=>'failed', 'message'=>'Invoice Drafted, make Publish Invoice'], 200);
        } else {
            if (count($cek)== 0) {
                $credit_client = (float)$client->credit - (float)$request->add_credit;
                $cln = Client::find($request->clientid)->update(['credit' => $credit_client]);
                if ($credit->save()) {
                    $total_inv = (float)$invoice->total - (float)$request->add_credit;
                    if ($request->add_credit == $request->c_balance_client) {
                        $inv = Invoice::find($request->id_invoice)
                                        ->update([
                                            'status'=>"Paid",
                                            'datepaid'=>date('Y-m-d'),
                                            'paymentmethod' => $payment_method
                                            ]);
                        // Payment::create([
                        //             'invoiceid' => $request->id_invoice,
                        //             'datepaid'  => date('Y-m-d'),
                        //             'amount'    => $request->add_credit,
                        //             'method'    => "Partial Credit"
                        //             ]);
                    }
                    $data = array(
                        'clientid'      => $request->clientid,
                        'invoiceid'     => $invoice->invoiceid,
                        'amountin'      => $request->add_credit,
                        'paymentmethod' => "Credit Applied",
                        'reference'     => 1
                    );  
                    $this->add_transaction($data);
                    $response = ['status' => 'success', 'message'=>'Credit Added to Invoice'];
                } else {
                    $response = ['status' => 'failed', 'message'=>'Failed to Add Credit'];
                }
            } else {
                $credit_client = (float)$client->credit - (float)$request->add_credit;
                $cln = Client::find($request->clientid)->update(['credit' => $credit_client]);
                $exist = $cek[0]->amount;
                $amount = (float)$exist + (float)$request->add_credit;
                $cr = Credit::where('userid', $request->clientid)
                                ->update(['amount' => $amount]);
                $total_inv = (float)$invoice->total - (float)$request->add_credit;
                if ($request->add_credit == $request->c_balance_client) {
                    $inv = Invoice::find($request->id_invoice)
                                    ->update([
                                        'status'=>"Paid"
                                        ]);
                }
                if ($cr) {
                    $data = array(
                        'clientid'      => $request->clientid,
                        'invoiceid'     => $invoice->invoiceid,
                        'amountin'      => $amount,
                        'paymentmethod' => "Credit Applied",
                        'reference'     => 1
                    );  
                    $this->add_transaction($data);
                    $response = ['status' => 'success', 'message'=>'Credit Added to Invoice'];
                } else {
                    $response = ['status' => 'failed', 'message'=>'Failed to Add Credit'];
                }
            }
            event(new MailEvent($client, $response));
            return response()->json($response, 200);
        }
    }

    public function remove_credit(Request $request){
        $inv_id = $request->id_invoice;
        $amount = $request->remove_credit;
        $cek    = Credit::where('userid', $request->clientid)->where('invoiceid', $inv_id)->get();
        $invoice    = Invoice::find($inv_id);
        $client     = Client::find($request->clientid);
        if($invoice->status == "Draft"){
            return response()->json(['status'=>'failed', 'message'=>'Invoice Drafted, make Publish Invoice'], 200);
        } else {
            if($amount > $cek[0]->amount){
                return response()->json(['status' => 'failed', 'message'=> "You can't apply credit more than credit invoice"],200);
            } else {
                $inv_credit = $cek[0]->amount;
                $update_credit = (float)$inv_credit - (float)$amount;
                $cr = Credit::find($cek[0]->creditid)->update([
                    'amount'    => $update_credit,
                    'type'      => "Remove",
                    'date'      => Carbon::now()->toDateTimeString(),
                    'adminid'   => $request->session()->get('userid'),
                ]);
                if($cr){
                    $credit_client = (float)$client->credit + (float)$amount;
                    $cln = Client::find($request->clientid)->update([
                            'credit'    => $credit_client
                    ]);
                    if ($cln) {
                        $data = array(
                            'clientid'      => $request->clientid,
                            'invoiceid'     => $invoice->invoiceid,
                            'amountout'     => $amount,
                            'paymentmethod' => "Remove Credit",
                            'reference'     => 1
                        );
                        $this->add_transaction($data);
                        return response()->json(['status'=>'success', 'message'=> "Successfull Remove Credit"], 200);
                    }
                } else {
                    return response()->json(['status'=>'failed', 'message'=> "Failed to Remove Credit"], 200);
                }
            }
        }
    }

    public function add_payment($id, Request $request)
    {   
        $mail = new MailModel();
        $sum = 0;
        $invoice    = Invoice::find($id);
        $client     = Client::find($request->payment_clientid);
        $payment    = Payment::where('invoiceid', '=', $id)->first();
        if($invoice->status == "Draft"){
            return response()->json(['status'=>'failed', 'message'=>'Invoice Drafted, make Publish Invoice'], 200);
        }
        if ($invoice->status != "Paid") {
            $total = $invoice->total;
                $payment = new Payment;
                $payment->invoiceid     = $id;
                $payment->method        = $request->payment_paymentmethod;
                $payment->amount        = $request->payment_amount;
                $payment->datepaid      = $request->payment_date;
                $payment->created_at    = Carbon::now()->toDateTimeString();
                if ($payment->save()) {
                    if($request->payment_amount > $total || $request->payment_amount > $request->payment_balance){
                        $sisa = (float)$request->payment_amount - (float)$request->payment_balance;
                        $credit_client = $client->credit + $sisa;
                        $update_client = Client::find($request->payment_clientid)
                                                ->update(['credit'=>$credit_client]);
                        $update = Invoice::find($id)->update(['status' => "Paid", 
                                                            'datepaid'=>$request->payment_date, 
                                                            'paymentmethod'=>$request->payment_paymentmethod]);
                    }elseif($request->payment_amount == $request->payment_balance){
                        $update = Invoice::find($id)->update(['status' => "Paid", 
                                                            'datepaid'=>$request->payment_date, 
                                                            'paymentmethod'=>$request->payment_paymentmethod]);
                    }else{
                        $update = Invoice::find($id)->update(['datepaid'=>$request->payment_date, 
                                                            'paymentmethod'=>$request->payment_paymentmethod]);
                    }
                    if($update){
                        $response = ['status'=>'success', 'message'=> 'Add Payment to Invoice Successful',
                                     'invoice_id'=>$id, 'amount'=>$request->payment_amount];
                    }else{
                        $response = ['status'=>'failed', 'message'=> 'Add payment to Invoice Failed','invoice_id'=>$id];
                    }
                    $data = array(
                        'clientid'      => $request->payment_clientid,
                        'invoiceid'     => $invoice->invoiceid,
                        'amountin'      => $request->payment_amount,
                        'paymentmethod' => $request->payment_paymentmethod,
                        'description'   => "Invoice Payment",
                        'reference'     => 1
                    );  
                    $this->add_transaction($data);
                } else {
                    $response = ['status'=>'failed', 'message'=> 'Add Payment to Invoice Failed', 'invoice_id'=>$id];
                }
                event(new MailEvent($client, $response));
                return response()->json($response, 200);
        }else{
            return response()->json(['status'=>'failed', 'message'=>"This Invoice has been Paid"], 200);
        }
        return response()->json($request->input(), 200);
    }

    public function mark_process(Request $request)
    {
        $status = $request->action;
        $id     = $request->id_inv;
        if($status == "Paid"){
            $invoice = Invoice::find($id)->update(['status' => $status, 'datepaid'=> date('Y-m-d')]);
        }else{
            $invoice = Invoice::find($id)->update(['status' => $status]);
            if($status == "Cancelled"){
                $response = ['result' => true, 'message' => 'Invoice Cancelled' ,'invoiceid'=>$id];
                event(new MailEvent($client, $response));
            }
        }
        if ($invoice) {
            return response()->json(['status'=>"success",
                                    'message'=>"Success update Invoice status to ".$status], 200);
        } else {
            return response()->json(['status'=>"failed", 'message'=> "Failed to update Invoice Status"], 200);
        }
    }
    
    public function search_invoice(Request $request, Invoice $invoice){
        // $invoice = Invoice::filterByRequest($request);
        $invoice = $invoice->newQuery();
        if ($request->has('userid')) {
            $invoice->where('userid', $request->userid);
        }
        if ($request->has('invoiceid')) {
            if($request->invoiceid != ""){
                $invoice->where('invoiceid', $request->input('invoiceid'));
            }
        }
        if ($request->has('payment')) {
            if($request->payment != "any"){
                $invoice->where('paymentmethod', $request->input('payment'));
            }
        }
        if ($request->has('status')) {
            if($request->status != "any"){
                $invoice->where('status', $request->input('status'));
            }
        }
        if ($request->has('date')) {
            if($request->date != ""){
                $invoice->where('date', $request->input('date'));
            }
        }
        if ($request->has('duedate')) {
            if($request->duedate != ""){
                $invoice->where('duedate', $request->input('duedate'));
            }
        }
        if ($request->has('datepaid')) {
            if($request->datepaid != ""){
                $invoice->where('datepaid', $request->input('datepaid'));
            }
        }
        return response()->json(['invoice'=>$invoice->get()], 200);
    }

    public function add_transaction($data){
        $add = Transaction::create($data);
        return $add;
    }

    public function merge_invoice(Request $request){
        $array      = $request->select;
        $max        = max($array);
        $invoice    = Invoice::find($max);
        $total_max  = (float)$invoice->total;
        foreach ($array as $value) {
            if($value != $max){
                $invoice_old = Invoice::find($value);
                $items = Item::where("invoiceid", $value)->get();
                foreach ($items as $item) {
                    $update_item = Item::find($item->itemid)
                                    ->update(['invoiceid' => $max]);
                }
                $payments = Payment::where('invoiceid', $value)->get();
                foreach ($payments as $payment) {
                    $update_payment = Payment::find($payment->paymentid)
                                        ->update(['invoiceid' => $max]);
                }
                $credits    = Credit::where('invoiceid', $value)->first();
                if(!empty($credits)){
                    $amount     = $credits->amount;
                    $credit_max = Credit::where('invoiceid', $max)->first();
                    if(!empty($credit_max)){
                        $credit_inv = (float)$credit_max->amount;
                        $credit_inv = $credit_inv + (float)$credits->amount;
                        $update     = Credit::find($max)
                                            ->update(['amount' => $credit_inv]);
                        if(!$update){
                            return response()->json(['status' => "fail", 'message'=>"Failed update credit to Invoice"], 200);
                        }
                    }else{
                        $create = Credit::create([
                                    'invoiceid' => $max,
                                    'userid'    => $credits->userid,
                                    'amount'    => $amount,
                                    'type'      => "Add",
                                    'date'      => Carbon::now()->toDateTimeString()
                        ]);
                        if(!$create){
                            return response()->json(['status' => "fail", 'message'=>"Failed add credit to Invoice"], 200);
                        }
                    }
                }
                $transactions = Transaction::where('invoiceid', $value)->get();
                foreach ($transactions as $key) {
                    $update_item = Transaction::find($key->id)
                                    ->update(['invoiceid' => $max]);
                }
                $delete = Invoice::find($value)->delete();
                if(!$delete){
                    return response()->json(['status' => "fail", 'message'=>"Failed to delete invoice"], 200);
                }
                $total_max = $total_max + (float)$invoice_old->total;
            }
        }
        $update = Invoice::find($max)->update(['total' => $total_max]);
        if(!$update){
            return response()->json(['status' => "fail", 'message'=>"Failed to Merge Invoice"], 200);
        }
        return response()->json(['status'=>"success", 'message'=>"Merge Invoice Successful"], 200);
    }

    public function mass_payment($id, Request $request)
    {
        $sum_total  = Invoice::whereIn('invoiceid', $request->select)->sum('total');
        $client     = Client::find($id);
        $invoice = Invoice::create([
                    'userid'        => $id,
                    'status'        => "Unpaid",
                    'paymentmethod' => $client->paymentmethod,
                    'draft'         => 1,
                    'sendInvoice'   => 1,
                    'date'          => date('Y-m-d'),
                    'duedate'       => config('help.DUE_DATE'),
                    'taxrate'       => config('help.TAXRATE'),
                    'notes'         => " ",
                    'total'         => $sum_total,
                    'published_at'  => Carbon::now()->toDateTimeString()
        ]);
        $id_inv = $invoice->invoiceid;
        $items = Item::whereIn('invoiceid', $request->select)->get();
        foreach($items as $val)
        {
            $item = Item::create([
                        'invoiceid'     => $id_inv,
                        'itemdescription'=> "Invoice #".$val->invoiceid,
                        'itemamount'    => $val->itemamount,
                        'itemtaxed'     => $val->itemtaxed
                    ]);
            if(!$item){
                return response()->json(['status'=>"fail", 'message'=>"failed to create item"], 200);
            }
        }
        $transactions = Transaction::whereIn('invoiceid', $request->select)->get();
        foreach ($transactions as $value) {
            $transaction = Transaction::create([
                        'clientid'      => $id, 
                        'invoiceid'     => $id_inv,
                        'amountin'      => $value->amountin,
                        'amountout'     => $value->amountout,
                        'fee'           => $value->fee,
                        'paymentmethod' => $value->paymentmethod,
                        'description'   => $value->description,
                        'date'          => date('Y-m-d'),
                        'reference'     => $value->reference
            ]);
            if(!$transaction){
                return response()->json(['status'=>"fail", 'message'=>"failed to create transaction"], 200);
            }
        }
        $a_credit   = Credit::whereIn('invoiceid', $request->select)->where('type', "Add")->sum('amount');
        $credit     = Credit::create([
                        'userid'    => $id,
                        'amount'    => $a_credit,
                        'type'      => "Add",
                        'date'      => Carbon::now()->toDateTimeString(),
                        'adminid'   => $request->session()->get('user_id'),
                        'invoiceid' => $id_inv
                    ]);
        if(!$credit){
            return response()->json(['status'=>'fail', 'message'=>"Credit failed to create"], 200);
        }
        $payments   = Payment::whereIn('invoiceid', $request->select)->get();
        foreach($payments as $val)
        {
            $payment = Payment::create([
                        'invoiceid' => $id_inv,
                        'datepaid'  => $val->datepaid,
                        'amount'    => $val->amount,
                        'method'    => $val->method
                    ]);
            if(!$payment){
                return response()->json(['status'=>"fail", 'message'=>"failed to create payment"], 200);
            }
        }
        return response()->json(['status'=>"success", 'message'=>'Mass Payment Created Successfully'], 200);
    }

    public function delete_multiinvoice(Request $request)
    {
        $array = $request->select;
        foreach($array as $value){
            $del = $this->delete_invoice($value);
        }
        return response()->json($del, 200);
    }

    public function add_refund($id, Request $request)
    {
        $invoice = Invoice::find($id);
        $client  = $invoice->userid;
        $client  = Client::find($client);
        $credit  = (float)$client->credit;

        $total  = $credit + (float)$request->refund_amount;
        $client->update([
            'credit'     => $total
        ]);
        $data = array(
            'clientid'      => $client->clientid,
            'invoiceid'     => $id,
            'amountout'     => $request->refund_amount,
            'paymentmethod' => "-",
            'date'          => date('Y-m-d'),
            'reference'     => 0
        );
        $create = $this->add_transaction($data);
        if ($create) {
            $response = ['status'=>'success', 'message' => 'Refund Successful', 'invoiceid'=>$id, 'params'=>$request->except('tickemail')];
        } else {
            $response = ['status'=>'failed', 'message' => 'Refund Failed', 'invoiceid'=>$id, 'params'=>$request->except('tickemail')];
        }
        if($request->tickemail != null){
            event(new MailEvent($client, $response));
        }
        return response()->json($response, 200);
    }
}
