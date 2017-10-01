<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Promotion;
use App\Account;
use App\Server;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class PromotionAPIController extends Controller
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
                            'body' => "We send you a promotion code!",
                            'sound' => "default"
                        ],
                        'data' => [
                            'code' => $code
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

            return response()->json([
                'message' => "Promotion codes sent."
            ]);
        }
        else return response()->json([
            'message' => "No registered user."
        ]);
    }

    public function delete(Request $request) {
        $promo = Promotion::where('promo_code', $request['promo_code']);
        $collection = $promo->get();
        
        if(!($collection->isEmpty()))
        {
            $promo->delete();

            return response()->json([
                'message' => "Promotion code deleted."
            ]);
        }

        return response()->json([
            'message' => "Invalid promotion code."
        ]);
    }

    public function check(Request $request)
    {
        $promo = Promotion::where('promo_code',$request['promo_code'])->get();

        if(!($promo->isEmpty()))
        {
            return response()->json([
                'message' => "valid"
            ]);
        }
        else
        {
            return response()->json([
                'message' => "invalid"
            ]);
        }
    }
}
