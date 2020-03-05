<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Client;
use App\Invoice;
use App\Transaction;
use App\Credit;
use App\Payment;
use App\MailModel;
use App\Events\MailEvent;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Validator;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function add_transaction(Request $request)
    {
        $clientid       = $request->clientid;
        $date           = $request->date;
        $description    = $request->description;
        $transactionid  = $request->transactionid;
        $invoiceid      = (int)$request->invoiceid;
        $paymentmethod  = $request->paymentmethod;
        $amountin       = (float)$request->amountin;
        $amountout      = (float)$request->amountout;
        $fee            = (float)$request->fee;
        $credit         = $request->credit;
        $client         = Client::find($clientid);
        if($amountin !=null  && $amountout != null){
            return response()->json(['status'=>"failed", 'message'=>"You cant add amount in and amount out"], 400);
        }elseif (($amountout != null || $fee != null) && $credit == "credit") {
            return response()->json(['status'=>"failed", 'message'=>"You cannot use Add as Credit and Amount Out"], 400);
        }elseif($invoiceid !=null && $credit == "credit"){
            return response()->json(['status'=>"failed", 'message'=>"You cannot use Add as Credit and specify an Invoice ID"], 400);
        }else{
            $transaction = Transaction::create([
                                'clientid'      => $clientid,
                                'date'          => $date,           
                                'description'   => $description,    
                                'transactionid' => $transactionid,  
                                'invoiceid'     => $invoiceid,      
                                'paymentmethod' => $paymentmethod,  
                                'amountin'      => $amountin,       
                                'amountout'     => $amountout,      
                                'fee'           => $fee,              
                            ]);
            if($transaction){
                $response = ['status'=>"success", 'message'=>'Add Transaction Successful', 'data'=> $request->input()];
            }else{
                $response = ['status'=>"failed", 'message'=>'Add Transaction Failed', 'data'=> $request->input()];
            }
            event(new MailEvent($client, $response));
            return response()->json($response, 200);
        }
    }

    public function delete_transaction($id)
    {
        $transaction = Transaction::find($id);
        if($transaction->delete()){
            return response()->json(['status'=>"success", 'message'=>'Transaction has been deleted'], 200);
        }else{
            return response()->json(['status'=>"failed", 'message'=>'Transaction Failed to Delete'], 400);
        }
    }

    public function fetch_transaction($id){
        $transaction = Transaction::where('clientid', $id)
                                    ->where('reference', '!=', 1)
                                    ->with('client')->get();
        return response()->json($transaction, 200);
    }

    public function getTransaction_byId($id){
        $transaction = Transaction::find($id);
        return response()->json($transaction, 200);
    }

    public function update($id, Request $request)
    {   
        $amountin   = $request->amountin;
        $amountout  = $request->amountout;
        $fee        = $request->fee;
        if($amountin == null){$amountin=0;}
        if($amountout == null){$amountout=0;}
        if($fee == null){$fee=0;}
        if($amountin !=0  && $amountout != 0){
            return response()->json(['status'=>"failed", 'message'=>"You cant add amount in and amount out"], 200);
        }else{
            $transaction = Transaction::find($id);
            $update = $transaction->update([
                                    'date'          => $request->date,
                                    'transactionid' => $request->transactionid,
                                    'paymentmethod' => $request->paymentmethod,
                                    'description'   => $request->description,
                                    'invoiceid'     => $request->invoiceid,
                                    'amountin'      => $amountin,
                                    'fee'           => $fee,
                                    'amountout'     => $amountout,
                                ]);
            if ($update) {
                return response()->json(['status' => "success", 'message'=>"Update Transaction Successful"], 200);
            } else {
                return response()->json(['status' => "failed", 'message'=>"Update Transaction Failed"], 200);
            }   
        }
        return response()->json($request->input(), 200);
    }
}
