<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use App\Account;
use App\Server;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class PromotionController extends Controller
{
    public function send(Request $request)
    {
        $registered = Account::get();

        if(!($registered->isEmpty()))
        {
            $server = Server::get()->first()['server_key'];
            $promo_number = rand(1,10000);

            foreach($registered as $account)
            {
                $account_number = rand(1,10000);
                $code = substr(md5("promo_" . $promo_number . "_" . $account_number . "_" . Carbon\Carbon::now()),0,12);

                $client = new Client();
                $response = $client->post("https://fcm.googleapis.com/fcm/send",[
                    'headers' => [
                        'Authorization' => "key=" . $server,
                        'Content-Type' => 'application/json'
                    ],
                    'json' => [
                        'to' => $account['firebase_key'],
                        'notification' => [
                            'title' => "Mobile, Inc.",
                            'body' => "We send you a promotion code!",
                            'sound' => "default"
                        ],
                        'data' => [
                            'code' => $code
                        ]
                    ]
                ]);
                
                $promotion = Promotion::where('account_id',$account['id'])->first();
                
                if(!empty($promotion))
                {
                    $promotion->update([
                        'promo_code' => $code,
                        'received' => false,
                        'used' => false
                    ]);
                }
                else
                {
                    $promo = Promotion::create([
                        'id' => rand(1,1000),
                        'account_id' => $account['id'],
                        'player' => $request['player'],
                        'promo_code' => $code,
                        'received' => false,
                        'used' => false
                    ]);
                }
            }

            $progress = "Promotion codes sent.";
        }
        else $progress = "No registered user.";

        return view('manage_promotion',compact('progress'));
    }
}
