<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];
}
