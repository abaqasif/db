<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'pack_size','quantity','shade','brand','type','rate','open_bal'
    ];

    public function sales_order(){

        return $this->belongsToMany('App\Sales_order')->withPivot('quantity','discount');
    }

    public function goods_return(){

        return $this->belongsToMany('App\Goods_return')->withPivot('quantity','discount');
    }

}
