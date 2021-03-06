<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $incrementing = false;
    protected $guarded = [];

    public function game()
    {
        return $this->belongsTo('App\Account');
    }
}
