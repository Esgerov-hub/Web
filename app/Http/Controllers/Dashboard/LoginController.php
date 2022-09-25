<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where(['email' => $request->email])->first();
//        dd($user);
        if ($user != null && $user->type != 0) {
            $credentials = $request->only('email', 'password');
        }else{
            return redirect(route('login'))->with('error','Məlumatınız doğru olmadığı üçün giriş edə bilmədiniz!');
        }

        if (auth()->attempt($credentials)) {

            return redirect()->route('dashboard.index')->with('success','Xoş gəldiniz!');

        }else{

            session()->flash('message', 'Invalid credentials');
            return redirect()->back();
        }
    }
}
