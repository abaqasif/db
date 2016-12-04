<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods_delivered extends Model
{
    protected $fillable = [
        'ddate', 'sales_order_id',
    ];

    public function order(){

        return $this->belongsTo('App\Sales_order');
    }
}
