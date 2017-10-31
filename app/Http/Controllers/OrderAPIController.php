<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Handphone;
use App\Promotion;
use App\Order;
use App\Trend;
use App\Statistic;
use App\Server;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class OrderAPIController extends Controller
{
    public function order(Request $request)
    {
        $first = true;
        $discount = false;

        $type = ["Mi_5","Mi_Max","Redmi_3s","Galaxy_Note_8","Galaxy_Note_5","Galaxy_S8+"];
        $account_id = Account::where('name',$request['account_name'])->first()['id'];

        $promo_code = $request['promo_code'];
        $promo_price = 1;
        
        if(!(empty($promo_code)))
        {
            $promotion = Promotion::where([
                ['promo_code', $promo_code],
                ['used', false]
            ])->first();

            if(!(empty($promotion))) $discount = true;
            else
            {
                return response()->json([
                    'message' => "Promo code either invalid or expired."
                ]);
            }
        }

        for($count = 0; $count < 6; $count++)
        {
            $model = $type[$count];
            $quantity = $request[$model];

            if($quantity != 0)
            {
                if($first) // count only once
                {
                    $first = false;

                    if($discount)
                    {
                        // Discount 10%
                        $promo_price =  0.9;
                        
                        $promotion->update([
                            'used' => true
                        ]);
                    }
                    
                    // Add statistics

                    $statistics = Statistic::where('city',$request['city'])->first();
                    
                    if(!(empty($statistics)))
                    {
                        $statistics->update([
                            'orders' => $statistics['orders'] + 1,
                            'updated_at' => Carbon::now()
                        ]);
                    }
                    else
                    {
                        if($request['city'] != "UNDEFINED")
                        {
                            Statistic::create([
                                'city' => $request['city'],
                                'orders' => 1,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now()
                            ]);
                        }
                    }
                }

                $phone_data = Handphone::where('type',$model)->first(); 
                $phone_id = $phone_data['id'];
                $phone_price = $phone_data['price'];

                // Player null at first
                $order = Order::create([
                    'id' => rand(1,1000),
                    'account_id' => $account_id,
                    'phone_id' => $phone_id,
                    'quantity' => $quantity,
                    'subtotal' => (int)($phone_price * $quantity * $promo_price),
                    'sent' => false,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                $trend = Trend::where('phone_id',$phone_id)->first();
                $trend->update([
                    'orders' => $trend['orders'] + $quantity,
                    'updated_at' => Carbon::now()
                ]);
            }
        }

        if($first)
        {
            return response()->json([
                'message' => "No item ordered."
            ]);
        }
        else
        {
            return response()->json([
                'message' => "Order success."
            ]);
        }
    }

    public function get(Request $request)
    {
        $orders = Order::where('sent',false)->get();
        $handphone = Handphone::get();
        $order_json = [];

        if(!($orders->isEmpty()))
        {
            foreach($orders as $order)
            {
                $order->update([
                    'sent' => true,
                    'player' => $request['player']
                ]);

                $phone = $handphone->where('id', $order['phone_id'])->first();
                $phone_brand = $phone['brand'];
                $phone_type = str_replace("_"," ",$phone['type']);

                $order_json = array_merge($order_json, array(array($phone_type => array($order['quantity'], $order['subtotal']))));
            }
        }
        
        return response()->json([
            "order" => $order_json
        ]);
    }

    public function send(Request $request)
    {
        $orders_db = Order::where('sent',true); 
        $orders = $orders_db->select('account_id')->distinct()->get();

        if(!($orders->isEmpty()))
        {
            $registered = Account::get();
            $server = Server::get()->first()['server_key'];
            
            foreach($orders as $order)
            {
                $account = $registered->where('id', $order['account_id'])->first();

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
                            'body' => "We have received your orders!",
                            'sound' => "default"
                        ]
                    ]
                ]);
            }

            $orders_db->delete();

            return response()->json([
                "message" => "Order confirmations sent."
            ]);
        }
        else return response()->json([
            "message" => "No available orders."
        ]);
    }
}