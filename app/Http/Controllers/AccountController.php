<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function regidtretion()
    {
        return view('fornt.register');
    }
    public function login()
    {

        return view('fornt.login');
    }

    public function proccessRegistretion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5|same:confrim_password',
            'confirm_password' => 'required'
        ]);

        if ($validator->passes()) {
            # code...
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function profile()
    {
        return view('fornt.Account.profile');
    }
}
