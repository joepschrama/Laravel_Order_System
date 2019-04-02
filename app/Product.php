<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
       'name',
       'price',
       'description',
       'ingredients',
       'category_id',
   ];

   public function category()
   {
        return $this->belongsTo('App\Category');
   }
}
