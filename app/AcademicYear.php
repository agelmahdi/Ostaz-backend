<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    protected $fillable = ['title_ar', 'title_en', 'slug_ar', 'slug_en'];

    public function streamers()
    {
        return $this->belongsToMany('App\Streamer');
    }
}
