<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filling extends Model
{
    //
    public function packings()
    {
        return $this->belongsTo('App\Packing');
    }
}
