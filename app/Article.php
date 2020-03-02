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

class Article extends Model 
{
    use SoftDeletes;
    protected $table = 'article';

    protected $fillable = [
        'article_title', 'article_description','article_status', 'category_id', 'user_id', 'created_at', 'updated_at', 'file', 'date_created'
    ];

    protected $primaryKey = 'article_id';

    protected $hidden = ['deleted_at','updated_at'];

    public function category(){
       return $this->belongsTo('App\Category');
    }
    public function user(){
       return $this->belongsTo('App\User');   
    }

    /**
     * Get the post title.
     *
     * @param  string  $value
     * @return string
     */
    public function getArticleTitleAttribute($value)
    {
        return strtoupper($value);
        // return ucfirst($value);
    }

    public function setArticleTitleAttribute($value)
    {
        $this->attributes['article_title'] = str_replace(' ', '-', $value);
    }

    //public $timestamps = false; jika tidak butuh field / tidak butuh mengisi created and updated_at
}
