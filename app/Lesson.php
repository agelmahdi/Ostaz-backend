<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{

    protected $fillable = ['title','slug','description','start','end','group_id'];

    public function group(){
        return $this->belongsTo('App\Group');
    }

}
