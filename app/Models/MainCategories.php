<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MainCategories extends Authenticatable
{
    use Notifiable;
    protected $table = 'main_categories';
    protected $fillable = [
        'translation_lang', 'translation_of','name','slug','photo','active','created_at','updated_at',
    ];

    protected static function boot()
    {
        parent::boot();
        MainCategories::observe(MainCategoryObserver::class);
    }

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

        public function vendors()      //get all vendors that are in this category
        {
            return $this->hasMany(Vendor::class, 'category_id' , 'id');
        }
        // get all sub categories for this main category
        public function subCategories()
        {
            return $this->hasMany(subCategory::class , 'category_id' , 'id');
        }

        // relation between main categories with itself in the class
          public function categories()
          {
            return  $this -> hasMany(self::class , 'translation_of');
          }



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
