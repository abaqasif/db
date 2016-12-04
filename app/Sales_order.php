<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales_order extends Model
{
    protected $fillable = [
        'total', 'party_id','sdate',
    ];


    public function party(){

        return $this->belongsTo('App\Party');
    }

//    public function delivery(){
//
//        return $this->hasOne('App\Goods_delivered');
//    }

    public function stock(){

        return $this->belongsToMany('App\Stock')->withPivot('quantity','discount');
    }





}
