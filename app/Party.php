<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    protected $fillable = [
        'name', 'area', 'address','salesmen_id', 'balance','open_balance', 'credit_limit' ,'day' , 'fax','mobile'
    ];


    public function salesmen(){

        return $this->belongsTo('App\Salesmen');
    }

    public function sales_order(){

        return $this->hasMany('App\Sales_order');
    }


    public function goods_return(){

        return $this->hasMany('App\Goods_return');
    }


    public function payment(){

        return $this->hasMany('App\Pay');
    }
}


