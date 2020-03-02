<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

//this is new
use Tymon\JWTAuth\Contracts\JWTSubject;

class Payment extends Model 
{
    protected $table = 'tblpayment';

    protected $fillable = [
        'invoiceid', 'datepaid', 'amount', 'method', 'created_at'
    ];

    protected $primaryKey = 'paymentid';
    public $timestamps = false;

    public function invoice(){
        return $this->belongsTo('App\Invoice');
    }
}
