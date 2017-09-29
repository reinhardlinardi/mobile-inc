<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    public $incrementing = false;
    protected $fillable = ['id','name','firebase_key'];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}