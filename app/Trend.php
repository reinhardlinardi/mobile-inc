<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trend extends Model
{
    protected $primaryKey = 'phone_id';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];
}
