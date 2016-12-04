<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods_return extends Model
{
    protected $fillable = [
        'total', 'party_id','rdate',
    ];


    public function party(){

        return $this->belongsTo('App\Party');
    }


    public function stock(){

        return $this->belongsToMany('App\Stock')->withPivot('quantity','discount');
    }

}
