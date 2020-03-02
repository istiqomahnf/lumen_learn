<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Client;
use App\Invoice;
use App\Item;
use App\Credit;
use App\Payment;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class MailController extends InvoiceController
{   
    public function send_email($response){
        $name_from = config('help.EMAIL_NAME');
        $data = array('name'=>"Istiqomah", 'data'=>$response);
        $send = Mail::send('mail', $data, function($message){
                $from = 'istiqomah2018@gmail.com';
                $to     = 'istiqomahnurfatayati@gmail.com';
                    $message->to($to, 'Istiqomah')
                            ->subject("Test Email from Me");
                    $message->from($from, 'Qoqom');
                });
    }
}
