<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'question_id','title','slug','right'
    ];
    public function question(){
        return $this->belongsTo('App\Question');
    }
    public function quiz(){
        return $this->belongsTo('App\Question')->quiz();
    }
}
