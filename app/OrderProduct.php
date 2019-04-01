<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $guarded = ['id'];
    public $timestamps = false;
    
    public function order() {
        return $this->hasOne('App\Order', 'id', 'order_id');
    }
}
