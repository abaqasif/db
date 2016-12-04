<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesmen extends Model
{
    protected $fillable = [
        'name', 'cell_other', 'cell', 'sleep'
    ];


    public function party(){

        return $this->hasMany('App\Party');
    }
}
