<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class adminLocalization extends Model
{
    protected $table='adminlocalizations';
    protected $fillable = [
        'key','value_en','value_ar'
    ];
}
