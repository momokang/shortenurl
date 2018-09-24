<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Analytic extends Model
{
    public $timestamps = false;

    protected $fillable = ['date', 'impression', 'url_id'];
}
