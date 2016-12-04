<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    //
    public function fillings()
    {
        return $this->hasMany('App\Filling');
    }
}
