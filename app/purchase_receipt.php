<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchase_receipt extends Model
{
	protected $table = 'purchase_receipt';
     public $timestamps = false;
    
     public function purchase_orders(){
    

    return $this->belongsTo('app/purchase_orders');
}

  
     public function purchase_return(){
    

    return $this->hasMany('app/purchase_return');
}


    public function payments(){
    

    return $this->hasMany('app/payments');
}



}
