<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Carbon\Carbon;

class AccountAPIController extends Controller
{
    public function add(Request $request)
    {
        $registered = Account::where('name', $request['name'])->first();

        if(!(empty($registered))) {
            $registered->update([
                'firebase_key' => $request['firebase_key'],
                'updated_at' => Carbon::now()
            ]);

            return response()->json([
                'message' => 'User updated.'
            ]);
        }
        else {
            $account = Account::create([
                'id' => rand(1,1000),
                'name' => $request['name'],
                'firebase_key' => $request['firebase_key'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            return response()->json([
                'message' => 'User added.'
            ]);
        }
    }
}
