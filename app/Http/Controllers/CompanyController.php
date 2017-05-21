<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Models\Account;
use App\Models\Company;
use App\Models\Job;
use Auth;

class CompanyController extends Controller
{
    /**
     * Get form signup company
     */
    public function getSignup()
    {
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        return view('company.signup', ['address' => $address]);
    }

    /**
     * Store company
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
            $fileName = str_random('10') . time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(Company::PATH_AVATAR, $fileName);
            $dataCompany['avatar'] = Company::PATH_AVATAR . $fileName;
            Company::create($dataCompany);
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('companies.index');
            }else return back()->with('error', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        } catch (\Exception $ex) {
            return back()->withInput()->with('error', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        }
    }

    /**
     * Show list job uncheck
     */
    public function listUncheckJob()
    {
        $jobs = Job::where('status', Job::DEACTIVE)
            ->where('company_id', auth()->user()->company->id)
            ->where('deleted_at', null)
            ->paginate(9);
        return view('job.list', compact('jobs'));
    }

    public function listCheckedJob()
    {
        $jobs = Job::where('status', Job::ACTIVE)
            ->where('company_id', auth()->user()->company->id)
            ->where('deleted_at', null)
            ->paginate(9);
        return view('job.list', compact('jobs'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::where('status', Job::ACTIVE)
            ->where('company_id', auth()->user()->company->id)
            ->where('deleted_at', null)
            ->paginate(15);

        return view('company.index', compact('jobs'));
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
        foreach ($company->jobs as $job) {
            $job->levels()->detach();
        }
        $company->jobs()->delete();
        $company->account()->delete();
        $company->delete();
        return redirect()->route('admins.index')->with('success', 'Xóa công ty thành công.');
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



    public function listMember() {
        $members = Member::orderBy('id', 'desc')->paginate(15);
        return view('member.list', compact('members'));
    }
}
