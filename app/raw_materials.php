<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class raw_materials extends Model
{
    
	public $timestamps = false;
	protected $table = 'raw_materials';


    public function suppliers(){
    

    return $this->belongsTo('app/suppliers');

    }



     public function recipes(){
        return $this->belongsToMany('App\Recipe','recipe_rm','rm_code','recipe_id');
    }
}
