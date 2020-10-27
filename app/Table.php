<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'table_nr', 'amount_of_seats',
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
