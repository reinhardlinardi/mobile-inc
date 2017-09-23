<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    protected $primaryKey = 'city';
    public $incrementing = false;
    protected $fillable = ['city','orders'];
}
