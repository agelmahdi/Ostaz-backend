<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localization extends Model
{
    protected $fillable = [
        'key','value_en','value_ar'
    ];
}
