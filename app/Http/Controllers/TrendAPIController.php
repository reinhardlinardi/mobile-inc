<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trend;
use App\Handphone;

class TrendAPIController extends Controller
{
    public function get(Request $request)
    {
        $trend = Trend::orderBy('orders','desc')->first();

        $type = Handphone::where('id', $trend['phone_id'])->first()['type'];
        $type = str_replace('_',' ',$type);

        return response()->json([
            "trending" => $type,
            "orders" => $trend['orders']
        ]);
    }
}