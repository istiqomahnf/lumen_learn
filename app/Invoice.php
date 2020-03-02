<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

//this is new
use Tymon\JWTAuth\Contracts\JWTSubject;

class Invoice extends Model 
{
    protected $table = 'tblinvoice';

    protected $fillable = [
        'userid', 'status', 'paymentmethod', 'draft', 'sendinvoice', 'date', 'duedate', 'taxrate', 'autoapplycredit', 'notes', 'datepaid', 'total', 'published_at'
    ];

    protected $primaryKey = 'invoiceid';

    public $timestamps = false;

    public function client(){
        return $this->belongsTo('App\Client', 'userid');
     }

    public function items(){
        return $this->hasMany('App\Item', 'invoiceid');
    }
    public function credit(){
        return $this->hasOne('App\Credit', 'invoiceid');
    }

    public function payment(){
        return $this->hasMany('App\Payment', 'invoiceid');
    }
}
