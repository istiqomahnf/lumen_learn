<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;
use App\User;
use App\Invoice;
use App\Client;
use Validator;
use App\MailModel;
use App\Events\MailEvent;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Esemve\Hook\Facades\Hook;


class ClientController extends Controller
{
     
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function login_client($id="", Request $request)
    {
        if ($id == "") {
            $email      = $request->email;
            $client = Client::where('email',$email)->first();
            $id = $client->clientid;
        }
        $client = Client::find($id);
        Config::set('auth.providers.users.model', Client::class);
        if(!empty($client)){
            if ($client->status == "Active") {
                try{
                    if(!$userToken=JWTAuth::fromUser($client)){
                        return response()->json(['status'=>'failed', 'message'=>"doesnt match"], 200);
                    }
                }catch(Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
                    return response()->json(['token_invalid'], $e->getStatusCode());
                }catch(Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
                    return response()->json(['token_expired'], $e->getStatusCode());
                }catch (Tymon\JWTAuth\Exceptions\JWTException $e){
                    return response()->json(['token_absent'], $e->getStatusCode());
                }
                $request->session()->put('client_token', $userToken);
                $request->session()->put('client_id', $client->clientid);
                return response()->json(['status' => "success", 'message'=>"Now u're heading to client page",
                                        'token'=>$userToken, 'clientid'=>$id], 200);
            } else {
                return response()->json(['status'=>'failed', 'message'=>"Client not Active"], 200);
            }
        } else {
            return response()->json(['status'=>'failed', 'message'=>"Client not found"], 200);
        }
    }

    public function logout(){
        Config::set('auth.providers.users.model', Client::class);
    }

    public function home_client($id){
        $data['client']     = Client::find($id);
        $data['n_invoice']  = Invoice::where('userid', $id)->get()->count();
    }

    public function create(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'firstname'     => 'string',
            'lastname'      => 'string',
            'email'         => 'required|email|unique:users',
            'password'      => 'required'
        ]);
        if($validator->passes()){
            $client = new Client();
            $client->firstname      = $request->firstname;
            $client->lastname       = $request->lastname;
            $client->companyname    = $request->companyname;
            $client->password       = Crypt::encrypt($request->password);
            $client->email          = $request->email;
            $client->phonenumber    = $request->phonenumber;
            $client->address        = $request->address;
            $client->city           = $request->city;
            $client->country        = $request->country;
            $client->postcode       = $request->postcode;
            $client->status         = $request->status;
            $client->paymentmethod  = $request->paymentmethod;
            $client->currency       = $request->currency;
            $client->credit         = $request->credit;

            if ($client->save()) {
                $message = "Client Data Successfully created";
                return response()->json(['status'=>"success", 'message'=>$message, 'data'=>$request->input()], 200);
            }else{
                return response()->json(['status'=>"err", 'message'=>"Save Client Data Failed"], 401);
            }
        }else{
            return response()->json(['status'=>false, 'message'=>"Error", 'error'=>$validator->errors()->all()], 401);
        }
        
    }

    public function all(){
        $client = Client::orderBy('clientid', 'ASC')->paginate(10);
        return view('client.all_client', ['client'=>$client]);
    }

    public function detail($id)
    {
        $client = Client::where('clientid', '=', $id)->get();
        $paid   = Invoice::where('userid', $id)->where('status', "Paid")->get()->count();
        $unpaid = Invoice::where('userid', $id)->where('status', "Unpaid")->get()->count();
        $draft  = Invoice::where('userid', $id)->where('status', "Draft")->get()->count();
        $cancel = Invoice::where('userid', $id)->where('status', "Cancelled")->get()->count();
        return view('client.detail_client', ['data'=>$client, 'paid'=>$paid, 'unpaid'=>$unpaid, 'draft'=>$draft, 'cancel'=>$cancel]);
    }

    public function clientinvoice($id)
    {   
        $invoices = Invoice::with('client')->where('userid', '=', $id)->get();
        return view('invoice.list_client_invoice', ['invoices' => $invoices, 'userid'=>$id]);
    }

    public function getInvoice($id)
    {
        $invoices = Invoice::with('client')->where('userid', '=', $id)->where('status','!=','Draft')->get();
        return response()->json(['invoice'=>$invoices], 200);
    }

    public function profile()
    {
        return response()->json(['user' => Auth::user()], 200);
    }

    public function allUsers()
    {
         return response()->json(['users' =>  User::all()->pluck('name')], 200);
    }

    public function singleUser($id)
    {
        try {
            $client = Client::findOrFail($id);

            return response()->json($client, 200);

        } catch (\Exception $e) {

            return response()->json(['message' => 'user not found!'], 404);
        }

    }
    public function update($id, Request $request)
    {   
        $mail = new MailModel();
        if($request->password == ""){
            $client = Client::find($id);
            $update = $client->update([
                            'firstname'     => $request->firstname,
                            'lastname'      => $request->lastname,
                            'companyname'   => $request->companyname,
                            'email'         => $request->email,
                            'phonenumber'   => $request->phonenumber,
                            'notes'         => $request->notes,
                            'address'       => $request->address,
                            'city'          => $request->city,
                            'postcode'      => $request->postcode,
                            'status'        => $request->status,
                            'paymentmethod' => $request->paymentmethod,
                            'currency'      => $request->currency,
                        ]);
        }else{
            $client = Client::find($id);
            $update = $client->update([
                            'firstname'     => $request->firstname,
                            'lastname'      => $request->lastname,
                            'companyname'   => $request->companyname,
                            'email'         => $request->email,
                            'password'      => Crypt::encrypt($request->password),
                            'phonenumber'   => $request->phonenumber,
                            'notes'         => $request->notes,
                            'address'       => $request->address,
                            'city'          => $request->city,
                            'postcode'      => $request->postcode,
                            'status'        => $request->status,
                            'paymentmethod' => $request->paymentmethod,
                            'currency'      => $request->currency,
                        ]);
        }
        if ($update) {
            $response = ['status'=>'success', 'message'=>"Client Data has been updated", 'client_id'=>$client->clientid];
        } else {
            $response = ['status'=>'failed', 'message'=>"Failed to update client", 'client_id'=>$client->clientid];
        }
        // $mail->send_email($response);
        if(event(new MailEvent($client, $response))){
            return response()->json($response, 200);
        }else{
            return response()->json(['status'=>'fail', 'message'=>"Error Listeners", 'client_id'=>$client->clientid], 200);
        }
        
    }

}
