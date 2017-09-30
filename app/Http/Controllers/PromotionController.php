<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use App\Account;
use App\Server;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class PromotionController extends Controller
{
    public function send(Request $request)
    {
        $registered = Account::get();

        dd($registered);

        if(!(empty($registered)))
        {
            $server = Server::get()->value('server_key');
            $promo_number = rand(1,1000);

            foreach($registered as $account)
            {
                $code = substr(md5("promo_" . $promo_number . "_" . str_random(8)),0,8);

                $client = new Client();
                $http_request = new GuzzleRequest('POST',"https://fcm.googleapis.com/fcm/send",[
                    'headers' => [
                        'Authorization' => "key=" . $server,
                        'Content-Type' => 'application/json'
                    ],
                    'json' => [
                        'to' => $account->value('firebase_key'),
                        'notification' => [
                            'title' => "Mobile, Inc.",
                            'body' => "You have a gift!\nCode : " . $code
                        ]
                    ]
                ]);
            }

            $progress = "Promotion codes sent.";
        }
        else $progress = "No registered user.";

        return view('manage_promotion',compact('progress'));
    }
}
