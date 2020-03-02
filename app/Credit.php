<?php 

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

//this is new
use Tymon\JWTAuth\Contracts\JWTSubject;

class Credit extends Model {
    
    protected $table = 'tblcredit';

    protected $fillable = ['userid', 'amount', 'type', 'date', 'adminid', 'invoiceid'];

    protected $primaryKey = 'creditid';
    
    public $timestamps = false;

    public function invoice(){
        return $this->belongsTo('App\Invoice', 'invoiceid');
    }

}

?>