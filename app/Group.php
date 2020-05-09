<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    protected $fillable = [
        'title',
        'slug',
        'description',
        'streamer_id',
        'academic_year_id',
        'subject_id',
        'start',
        'end'
    ];
    public function streamer(){
        return $this->belongsTo('App\Streamer');
    }
    public function academic_year(){
        return $this->belongsTo('App\AcademicYear');
    }
    public function subject(){
        return $this->belongsTo('App\Subject');
    }

}
