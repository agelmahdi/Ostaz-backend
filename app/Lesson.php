<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $fillable = ['title','description','stock','start','end'];

    public function group(){
        return $this->belongsTo('App\Group');
    }

}
