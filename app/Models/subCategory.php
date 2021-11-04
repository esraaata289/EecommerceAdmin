<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class subCategory extends Model
{
    use Notifiable;
    protected $table = 'sub_categories';
    protected $fillable = [
        'translation_lang', 'translation_of','name','slug','photo','active','created_at','updated_at',
        'parent_id',
    ];
    public function scopeActive($query)
    {
        return $query -> where('active','1');
    }

    public function scopeSelection($query)
    {
        return  $query->select('id','name','slug','translation_lang','photo','active','translation_of');
    }

    public function getPhotoAttribute($val)
    {
        if($val != null)
        {
            return asset('assets/'.$val);
        }
        else{
            return "";
        }
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
    public function scopeDefaultCategory($query)
    {
        return $query -> where('translation_of' , 0);
    }
    //get the main category for these sub categories
    public function mainCategory()
    {
        return $this -> belongsTo(MainCategories::class , 'category_id' , 'id');
    }
    protected $hidden = [
         'remember_token',
    ];
}
