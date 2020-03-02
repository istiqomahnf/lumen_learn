<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Database\Eloquent\SoftDeletes;

//this is new
use Tymon\JWTAuth\Contracts\JWTSubject;

class Transaction extends Model 
{
    protected $table = 'tbltransaction';

    protected $fillable = ['transactionid', 'clientid', 'invoiceid', 'amountin', 'amountout', 'paymentmethod', 'description', 'created_at', 'updated_at'];
}