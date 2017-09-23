<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $incrementing = false;
    protected $fillable = ['id','name'];

    public function games()
    {
        return $this->hasMany('App\Game');
    }
}