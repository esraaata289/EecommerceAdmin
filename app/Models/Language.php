<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    protected $fillable = [
        'abbr', 'locale','name','direction','active','created_at','updated_at',
    ];

    public function scopeActive($query)
    {
        return $query->where('active',1);
    }
    public function scopeSelection($query)
    {
        return $query->select('Id','name','abbr','direction','active');
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
}
