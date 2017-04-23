<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Auth;

class LoginController extends Controller
{
    /**
     * Get login
     */
    public function getLogin(){
        if (Auth::user()->role == 1) return redirect()->intended(route('admins.index'));
        elseif (Auth::user()->role == 2) return redirect()->intended(route('companies.index'));
        elseif (Auth::user()->role == 3) return redirect()->intended(route('members.index'));
        else return view('site.login.index');
    }

    /**
     * Post login
     */
    public function postLogin(LoginRequest $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role == 1) return redirect()->route('admins.index');
            elseif (Auth::user()->role == 2) return redirect()->route('companies.index');
            else return redirect()->route('members.index');
        }else{
            return redirect()->back()->withInput()->with('error','Sai email hoặc mật khẩu !');
        }
    }

    /**
     *
     * Logout
     */
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
