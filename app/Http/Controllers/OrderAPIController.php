<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Handphone;
use App\Promotion;
use App\Order;
use App\Trend;

class OrderAPIController extends Controller
{
    public function order(Request $request)
    {
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
            }

            // update tabel statistics
        }

        return response()->json([
            'message' => 'Order success.'
        ]);
    }

    // function send, ubah send jadi true trus FCM
}