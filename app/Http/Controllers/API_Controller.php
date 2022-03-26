<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class API_Controller extends Controller
{
    public function login_API(Request $request)
    {
        $request->validate([
            'username' => "required",
            'password' => "required"
        ]);

        $user = User::where('username',$request->username)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json(['success' => true, 'message' => 'Login Successful'], 201);
        } else {
            return response()->json(['success' => false, 'message' => 'Login Failed'], 401);
        }
    }

    public function register_API(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email',
            'telephone' => 'required',
            'password' => 'required'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->telephone;
        $user->password = bcrypt($request->password);

        Session::flash('success', $user->save());
        return response()->json(['success' => true, 'message' => 'Register Successful'], 201);
    }

    public function getUser_API(Request $request)
    {
        $user = User::find($request->query('id'));
        if ($user) {
            return response()->json(['success' => true, 'data' => $user], 200);
        } else {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }
    }
}
