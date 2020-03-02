<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Mail;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;


class MailModel extends Model 
{
    public function send_email($response){
        $name_from = config('help.EMAIL_NAME');
        $data = array('name'=>"Istiqomah", 'data'=>$response);
        $send = Mail::send('mail', $data, function($message){
                $from = 'istiqomah2018@gmail.com';
                $to     = 'istiqomahnurfatayati@gmail.com';
                    $message->to($to, 'Istiqomah')
                            ->subject("Test Email from Me");
                    $message->from($from, 'Istiqomah');
                });
    }
}
