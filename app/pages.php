<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pages extends Model
{

	public function user_access(){

   return $this->hasMany('App\user_access');


   }
    
}
