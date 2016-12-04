<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payments extends Model
{
    
	protected $table = 'payments';
	public $timestamps = false;
    public function purchase_receipt(){
    

    return $this->belongsTo('app/purchase_receipt');
}}
