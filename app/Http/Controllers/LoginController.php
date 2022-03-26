<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.login');
    }
    public function register()
    {
        return view('login.register');
    }

    public function signUp(Request $request)
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
        return redirect()->route('login');
    }

    public function signIn(Request $request)
    {
        $request->validate([
            'username' => "required",
            'password' => "required"
        ]);

        $user = Auth::attempt(['username' => $request->username, 'password' => $request->password]);
        if ($user) {
            Auth::login(User::where(['username' => $request->username])->firstOrFail());
            return redirect()->route('admin.index');
        }
        Session::flash('login', false);
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
