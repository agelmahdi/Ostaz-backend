<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $fillable=['governorate_name','governorate_name_en'];
    public function cities(){
        return $this->hasMany('App\City','gov_id');
    }
}
