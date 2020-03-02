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
        $invoice = Invoice::find($id)->update([
                                    'status'        => 'Unpaid',
                                    'sendinvoice'   => 1,
                                    'published_at'  => Carbon::now()->toDateTimeString()
                                ]);
        if ($invoice) {
            return response()->json(['status' => 'success', 'message'=>'Invoice has been published to client'], 200);
        }else{
            return response()->json(['status' => 'failed', 'message' => 'Failed to publish Invoice'], 500);
        }
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
                        Payment::create([
                                    'invoiceid' => $request->id_invoice,
                                    'datepaid'  => date('Y-m-d'),
                                    'amount'    => $request->add_credit,
                                    'method'    => "Partial Credit"
                                    ]);
                    } else {
                        $inv = Invoice::find($request->id_invoice)->update(['total'=> $total_inv]);
                    }
                    $data = array(
                        'clientid'      => $request->clientid,
                        'invoiceid'     => $invoice->invoiceid,
                        'amountin'      => $request->add_credit,
                        'paymentmethod' => "Credit Applied"
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
                        'paymentmethod' => "Credit Applied"
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
                        'paymentmethod' => $request->payment_paymentmethod
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
        Transaction::create($data);
    }
}
