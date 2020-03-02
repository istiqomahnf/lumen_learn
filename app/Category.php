<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

//this is new
use Tymon\JWTAuth\Contracts\JWTSubject;

class Category extends Model 
{
    protected $table = 'category';
    protected $fillable = [
        'category_name', 'created_at', 'updated_at'
    ];

    public function article(){
       return $this->hasMany('App\Article');
    }
}
