<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use App\Language;
use App\Level;
use App\Account;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use Auth;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class IndexController extends Controller
{
    public function index(){
        $regions = Region::all();
        $languages = Language::all();
        $levels = Level::all();

        return view('index', ['regions' => $regions, 'languages' => $languages, 'levels' => $levels]);
    }

    public function getLogin(){
        return view('login');
    }

    public function postLogin(LoginRequest $request){
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            echo 'ok';
        }else{
            echo 'not ok';
        }

    }

    public function getSignupUser(){
        return view('signup-user');
    }

    public function postSignupUser(SignupRequest $request){
        $account = new Account;
        $account->name = $request->name;
        $account->email = $request->email;
        $account->password = bcrypt($request->name);
        $account->status = 0;
        $account->role = 'user';

        if($account->save()){
            return redirect()->route('login')->with('success', 'Đăng kí thành công. Vui lòng đăng nhập !');
        }else{
            return back()->withInput()->with('errorSystem', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        }   
    }

    public function getSignupCompany(){
        return view('signup-company');
    }

    public function postSignupCompany(SignupRequest $request){
        $account = new Account;
        $account->name = $request->name;
        $account->email = $request->email;
        $account->password = bcrypt($request->name);
        $account->status = 0;
        $account->role = 'company';

        if($account->save()){
            return redirect()->route('login')->with('success', 'Đăng kí thành công. Vui lòng đăng nhập !');
        }else{
            return back()->withInput()->with('errorSystem', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        }
    }
}
