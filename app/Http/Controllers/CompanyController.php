<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Requests\CompanyRequest;
use App\Models\Account;
use App\Models\Company;
use Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        return view('company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show profile
     *
     * @return view
     */
    public function profile()
    {
        dd(1);
        $company = auth()->user()->company->avatar;

        return view('company.profile', compact('company'));
    }

    /**
     * Get form signup
     *
     * @return view
     */
    public function getSignup()
    {
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        return view('company.create', ['address' => $address]);
    }

    /**
     * Post form signup
     *
     * @return redirect
     */
    public function postSignup(CompanyRequest $request)
    {
        $account = new Account;
        $account->email = $request->email;
        $account->password = bcrypt($request->password);
        $account->role = '2';

        if($account->save()){
            $company = new Company;
            $company->account_id = $account->id;
            $company->name = $request->name;
            $company->address_id = $request->address_id;
            $company->phone = $request->phone;
            $company->about = $request->about;

            $path = "images/avatars/";
            $fileName = str_random('10') . time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move($path, $fileName);
            $company->avatar = $path . $fileName;

            if ($company->save()) {
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    return redirect()->route('companies.index');
                }else return back()->with('errorSystem', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
            }else return back()->with('errorSystem', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        }else return back()->with('errorSystem', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
    }

    /**
     * List company
     *
     * @return view
     */
    public function list()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(15);

        return view('company.list', compact('companies'));
    }
}
