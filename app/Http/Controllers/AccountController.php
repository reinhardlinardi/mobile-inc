<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use Carbon\Carbon;

class AccountController extends Controller
{
    public function add(Request $request)
    {
        $account = Account::create([
            'id' => rand(1,100),
            'name' => $request['name'],
            'firebase_key' => $request['firebase_key'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        $add = "User added.";
        return view('manage_user',compact('add'));
    }
}
