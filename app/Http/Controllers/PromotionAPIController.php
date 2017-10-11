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
                $code = substr(md5("promo_" . $promo_number . "_" . $account_number),0,12);

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

            return response()->json([
                'message' => "Promotion codes sent."
            ]);
        }
        else return response()->json([
            'message' => "No registered user."
        ]);
    }

    public function update(Request $request) {
        $account = Account::where('name', $request['name'])->first();

        if(!(empty($account)))
        {
            $promo = Promotion::where('account_id', $account['id'])->first();

            return response()->json([
                'message' => "Promotion update success.",
                'promo_code' => $promo['promo_code']
            ]);
        }
        else
        {
            return response()->json([
                'message' => "Invalid account name."
            ]);
        }
    }

    public function confirm(Request $request)
    {
        $promo = Promotion::where('promo_code',$request['promo_code'])->first();
        
        if(!(empty($promo)))
        {
            $promo->update([
                'received' => true
            ]);

            return response()->json([
                'message' => "Confirmation success."
            ]);
        }
        else
        {
            return response()->json([
                'message' => "Invalid promotion code."
            ]);
        }
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
