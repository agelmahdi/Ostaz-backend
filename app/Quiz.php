<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Quiz extends Model
{
    use SoftDeletes;
    protected $fillable=['title','slug','time','lang','questions_number','streamer_id'];
    public function questions(){
        return $this->hasMany('App\Question')->with('answers');
    }
    public function streamer(){
        return $this->belongsTo('App\Streamer');
    }
}
