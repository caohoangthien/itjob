<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        unlink(Company::find($id)->avatar);
        $company = Company::find($id);
        $company->account->delete();
        $company->delete();
        return redirect()->route('admins.index');
    }

    /**
     * Get form signup
     *
     * @return view
     */
    public function getSignup()
    {
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        return view('company.signup', ['address' => $address]);
    }

    /**
     * Post form signup
     *
     * @return redirect
     */
    public function postSignup(CompanyCreateRequest $request)
    {
        try {
            $dataAccount = $request->only('email', 'password');
            $dataAccount['password'] = bcrypt($dataAccount['password']);
            $dataAccount['role'] = 2;
            $account = Account::create($dataAccount);
            $dataCompany = $request->only('name', 'address_id', 'phone', 'about');
            $dataCompany['account_id'] = $account->id;
            $path = "images/avatars/";
            $fileName = str_random('10') . time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move($path, $fileName);
            $dataCompany['avatar'] = $path . $fileName;
            Company::create($dataCompany);
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('companies.index');
            }else return back()->with('error', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        } catch (\Exception $ex) {
            return back()->withInput()->with('error', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        }
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

    /**
     * Show profile
     *
     * @return view
     */
    public function showProfile()
    {
        $profile = auth()->user()->company;
        return view('company.profile', compact('profile'));
    }

    /**
     * Edit profile
     *
     * @return view
     */
    public function editProfile()
    {
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        $profile = auth()->user()->company;
        return view('company.edit', compact('profile', 'address'));
    }

    /**
     * Update profile
     *
     * @return view
     */
    public function updateProfile(CompanyUpdateRequest $request)
    {
        $account = Account::find(auth()->id());
        $company = Company::where('account_id', $account->id);
        $dataAccount = $request->only(['email']);
        if ($request->password) {
            $dataAccount['password'] = bcrypt($request->password);
        }
        $dataCompany = $request->only(['name', 'address_id', 'phone', 'about']);
        if ($account->update($dataAccount) && $company->update($dataCompany)) {
            return redirect()->route('companies.profile.show')->with('success', 'Cập nhật thông tin công ty thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thông tin công ty thất bại');
        }
    }

    public function updateImage(Request $request)
    {
        unlink($request->oldImage);
        $path = "images/avatars/";
        $fileName = str_random('10') . time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move($path, $fileName);
        $data['avatar'] = $path . $fileName;
        Company::where('account_id', auth()->id())->first()->update($data);

        return response()->json([
            'message' => 'Success',
            'fileName' => $data['avatar'],
        ]);
    }
}
