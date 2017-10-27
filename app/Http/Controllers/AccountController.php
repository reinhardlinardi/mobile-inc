<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Carbon\Carbon;

class AccountController extends Controller
{
    public function add(Request $request)
    {
        $name_registered = Account::where('name', $request['name'])->first();
        $key_registered = Account::where('firebase_key', $request['firebase_key'])->first();

        if(!(empty($name_registered))) {
            $name_registered->update([
                'firebase_key' => $request['firebase_key'],
                'updated_at' => Carbon::now()
            ]);

            $add = "User updated.";
        }
        else if(!(empty($key_registered))) {
            $key_registered->update([
                'name' => $request['name'],
                'updated_at' => Carbon::now()
            ]);

            $add = "User updated.";
        }
        else {
            $account = Account::create([
                'id' => rand(1,1000),
                'name' => $request['name'],
                'firebase_key' => $request['firebase_key'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            $add = "User added.";
        }
        
        return view('manage_user',compact('add'));
    }
}
