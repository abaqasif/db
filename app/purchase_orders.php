<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchase_orders extends Model
{
    
		protected $table = 'purchase_orders';
		protected $fillable = ['total'];
			public $timestamps = false;
     public function purchase_order_line(){
    

    return $this->hasMany('app/purchase_order_line');

}


public function purchase_receipt(){
    

    return $this->hasMany('app/purchase_receipt');

}





}
