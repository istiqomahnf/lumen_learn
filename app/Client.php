<?php 

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

//this is new
use Tymon\JWTAuth\Contracts\JWTSubject;

class Client extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject {
    use Authenticatable, Authorizable;


    protected $table = 'tblclient';
    protected $fillable = ['firstname', 'lastname', 'companyname', 'email', 'address', 'city', 'postcode', 'country', 'phonenumber', 'password', 'paymentmethod', 'notes', 'currency', 'created_at', 'updated_at', 'credit', 'status'];
    // protected $guarded = 'clientid';
    protected $primaryKey = 'clientid';

    public function invoice(){
        return $this->hasMany('App\Invoice');
    }
    public function transaction(){
        return $this->hasMany('App\Transaction');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}

?>