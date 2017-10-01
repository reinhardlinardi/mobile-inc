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
            $promo_number = rand(1,1000);

            foreach($registered as $account)
            {
                $account_number = rand(1000,9999);
                $code = substr(md5("promo_" . $promo_number . "_" . $account_number),0,8);

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
                            'body' => "You have a gift!\nCode : " . $code
                        ]
                    ]
                ]);
                
                $promotion = Promotion::create([
                    'id' => rand(1,1000),
                    'player' => $request['player'],
                    'promo_code' => $code,
                    'used' => false
                ]);
            }

            $progress = "Promotion codes sent.";
        }
        else $progress = "No registered user.";

        return view('manage_promotion',compact('progress'));
    }
}
