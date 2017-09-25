<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $incrementing = false;
    protected $fillable =   ['id','account_id','player'];

    public function user()
    {
        return $this->belongsTo('App\Account');
    }

    public function promotions()
    {
        return $this->hasMany('App\Promotion');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
