<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'served',
        'time',
        'done',
        'table_id',
    ];
    
    public function products()
    {
        return $this->belongsToMany( 'App\Product', 'order_products', 'order_id', 'product_id' );
    }
    
    
   public function table()
   {
        return $this->belongsTo('App\Table');
   }
}
