<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'quiz_id','title','slug'
    ];
    public function quiz(){
        return $this->belongsTo('App\Quiz');
    }
    public function answers(){
        return $this->hasMany('App\Answer');
    }
}
