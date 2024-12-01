<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function regidtretion()
    {
        return view('fornt.Account.register');
    }
    public function login()
    {
        return view('fornt.Account.login');
    }

    public function proccessRegistretion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        // dd($request->all());

        if ($validator->passes()) {
            //create user
            $user = new User();

            $user->name = $request->name;
            $user->email =  $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success', 'You have register succesfully');
            return response()->json([
                'status' => true,
                'errors' => []
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function authencate(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);
        // return
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                # code...
                return redirect()->route('account.profile');
            } else {
                return redirect()->route('account.login')->with('error', 'Either Email/Password is incurrect');
            }
        } else {
            return redirect()
                ->route('account.login')
                ->withErrors($validator)
                ->withInput($request->only('email'));
        }
    }

    public function profile()
    {
        return view('fornt.Account.profile');
    }
}
