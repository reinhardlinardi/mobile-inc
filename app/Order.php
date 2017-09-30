<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];

    public function game()
    {
        return $this->belongsTo('App\Account');
    }
}
