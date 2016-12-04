<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_access extends Model
{

   protected $table='user_access';
   public $timestamps=false;
   
    public function pages(){

   return $this->belongsTo('App\pages');


   }



public function User(){

   return $this->belongsTo('App\User');


   }
}
