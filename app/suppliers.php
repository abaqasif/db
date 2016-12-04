<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class suppliers extends Model
{
    
	public $timestamps = false;


	protected $table = 'suppliers';
	
    public function raw_materials(){
    

    return $this->hasMany('app/raw_materials');



    }
}
