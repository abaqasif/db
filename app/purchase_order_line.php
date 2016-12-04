<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchase_order_line extends Model
{
    

	protected $table = 'purchase_order_lines';

	protected $fillable = ['total','tax_rate','tax_amount','qty'];
		public $timestamps = false;
     public function purchase_orders(){
    

    return $this->belongsTo('app/purchase_orders');
}
}