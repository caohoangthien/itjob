<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Models\Account;
use Mail;

class LoginController extends Controller
{
    /**
     * Get login
     */
    public function getLogin(){
        if (auth()->check() && auth()->user()->role == 1) return redirect()->intended(route('admins.index'));
        elseif (auth()->check() && auth()->user()->role == 2) return redirect()->intended(route('companies.index'));
        elseif (auth()->check() && auth()->user()->role == 3) return redirect()->intended(route('members.index'));
        else return view('site.login.index');
    }

    /**
     * Post login
     */
    public function postLogin(LoginRequest $request){
        $account = Account::where('email', $request->email)->where('deleted_at', null)->first();
        if(($account != null) && auth()->attempt(['email' => $request->email, 'password' => $request->password]) ) {
            if (auth()->user()->role == 1) return redirect()->route('admins.index');
            elseif (auth()->user()->role == 2) return redirect()->route('companies.index');
            else return redirect()->route('members.index');
        }else{
            return redirect()->back()->withInput()->with('error','Sai email hoặc mật khẩu !');
        }
    }

    /**
     * Logout
     */
    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }

    /**
     * Get forgot password
     */
    public function getForgot(){
        return view('site.login.forgot-password');
    }

    /**
     * Send emaifogot password
     */
    public function postForgot(ForgotPasswordRequest $request){
        $newPassword = rand();
        $account = Account::where('email', $request->email)->first();
        if ($account) {
            $data['password'] = bcrypt($newPassword);
            $account->update($data);
            Mail::send('site.mail.forgot-password', array('newPassword'=>$newPassword), function($message) use ($request){
                $message->to($request->email, 'Lập trình viên')->subject('Mật khẩu mới');
            });
            return redirect()->back()->withInput()->with('message', 'Chúng tôi đã gởi mật khẩu về email của bạn. Vui lòng kiểm tra lại.');
        } else {
            return redirect()->back()->withInput()->with('message', 'Email không tồn tại.');
        }
    }
}
