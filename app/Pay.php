<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    protected $fillable = [
        'pdate', 'cheque', 'token', 'total','cash','party_id',
    ];


    public function party(){

        return $this->belongsTo('App\Party');
    }
}
