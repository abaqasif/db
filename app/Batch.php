<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Batch extends Model

{
    //
    public function tests()
    {
        return $this->hasMany('App\Test', 'batch_id');
    }
    public function fillings()
    {
        return $this->hasMany('App\Filling', 'batch_id');
    }

}
