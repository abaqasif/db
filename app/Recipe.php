<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    public function raw_materials(){
        return $this->belongsToMany('App\Raw_Material','recipe_rm','recipe_id','rm_code');
    }
}
