<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchase_return extends Model



{


	protected $table = 'purchase_return';
     public $timestamps = false;
     public function purchase_receipt(){
    

    return $this->belongsTo('app/purchase_receipt');
}
}
