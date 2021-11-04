<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;

    protected $table = 'vendors';
    protected $fillable = [
        'name', 'email','mobile','password','address','created_at','updated_at','category_id',
        'active','logo','latitude' ,'longitude'
    ];
    protected $hidden = [
        'category_id', 'remember_token',
    ];

    public function ScopeActive($query)
    {
        return $query -> where('active' , 1);
    }
    public function getLogoAttribute($val)
    {
        if($val != null)
        {
            return asset('assets/'.$val);
        }
        else{
            return "";
        }
    }
    public function scopeSelection($query)
    {
      return  $query->select('id','category_id','name','logo','mobile','active','address','email','longitude','latitude');
    }
    public function getActive()
    {
        if($this->active == 1)
        {
            return 'Active';
        }
        else
        {
            return 'Not Active';
        }
        //return $this -> active = 1 ? 'Active' : 'Not Active';
    }

    public function setPasswordAttribute($password)
    {
         if(!empty($password))
         {
             $this -> attributes['password'] = bcrypt($password);
         }
    }

    public function category()
    {
        return $this->belongsTo(MainCategories::class ,'category_id' , 'id');
    }
}
