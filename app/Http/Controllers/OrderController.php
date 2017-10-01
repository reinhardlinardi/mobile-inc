<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Account;
use App\Server;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class OrderController extends Controller
{
    public function mark(Request $request)
    {
        $orders = Order::where('sent',false)->get();

        if(!($orders->isEmpty()))
        {
            foreach($orders as $order)
            {
                $order->update([
                    'sent' => true,
                    'player' => $request['player']
                ]);
            }

            $message = "Success.";
        }
        else $message = "No available orders.";
        
        return view('manage_confirmation',compact('message'));
    }

    public function send(Request $request)
    {
        $orders_db = Order::where('sent',true);
        $orders = $orders_db->groupBy('account_id')->get();

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
                            'body' => "We have received your order!"
                        ]
                    ]
                ]);
            }

            $orders_db->delete();
            $progress = "Order confirmations sent.";
        }
        else $progress = "No available orders.";

        return view('manage_confirmation',compact('progress'));
    }
}
