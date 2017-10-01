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

        $type = ["Mi_5","Mi_Max","Redmi_3s","Galaxy_Note_8","Galaxy_Note_5","Galaxy_S8+"];
        $account_id = Account::where('name',$request['account_name'])->first()['id'];

        for($count = 0; $count < 6; $count++)
        {
            $model = $type[$count];
            $quantity = $request[$model];

            if($quantity != 0)
            {
                $phone_data = Handphone::where('type',$model)->first(); 
                $phone_id = $phone_data['id'];
                $phone_price = $phone_data['price'];
                $promo_code = $request['promo_code'];
                
                if(empty($promo_code)) $promo_price = 1;
                else {
                    // Discount 10%
                    $promo_price =  0.9;
                    $promotion = Promotion::where('promo_code', $promo_code)->first();
                    $promotion->update([
                        'used' => true
                    ]);
                }

                // Player null at first
                $order = Order::create([
                    'id' => rand(1,1000),
                    'account_id' => $account_id,
                    'phone_id' => $phone_id,
                    'quantity' => $quantity,
                    'subtotal' => (int)($phone_price * $quantity * $promo_price),
                    'sent' => false
                ]);

                $trend = Trend::where('phone_id',$phone_id)->first();
                $trend->update([
                    'orders' => $trend['orders'] + $quantity
                ]);

                if($first) // count only once
                {
                    $first = false;
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
                        Statistic::create([
                            'city' => $request['city'],
                            'orders' => 1,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }
        }

        return response()->json([
            'message' => 'Order success.'
        ]);
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
                $phone_name = $phone_brand . " " . $phone_type;

                $order_json = array_merge($order_json, array($phone_name => array($order['quantity'], $order['subtotal'])));
            }
        }
        
        return response()->json([
            "order" => $order_json
        ]);
    }

    public function send(Request $request)
    {
        $orders_db = Order::where('sent',true); 
        $orders = $orders_db->groupBy('account_id','order_id')->get();

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
                            'body' => "We have received your orders!"
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