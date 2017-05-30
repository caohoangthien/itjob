<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use App\Http\Requests\CompanyCreateRequest;
use App\Http\Requests\CompanyUpdateRequest;
use App\Http\Requests\JobCreateRequest;
use App\Models\Account;
use App\Models\Company;
use App\Models\Job;
use App\Models\Member;
use App\Models\Skill;
use App\Models\Salary;
use App\Models\Level;
use Auth;

class CompanyController extends Controller
{
    public function getSignup()
    {
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        return view('company.signup', ['address' => $address]);
    }

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

    public function index()
    {
        $jobs = Job::where('status', Job::DEACTIVE)
            ->where('company_id', auth()->user()->company->id)
            ->paginate(8);
        return view('company.job.list', compact('jobs'));
    }

    public function listUncheckJob()
    {
        $jobs = Job::where('status', Job::DEACTIVE)
            ->where('company_id', auth()->user()->company->id)
            ->where('deleted_at', null)
            ->paginate(8);
        return view('company.job.list', compact('jobs'));
    }

    public function listCheckedJob()
    {
        $jobs = Job::where('status', Job::ACTIVE)
            ->where('company_id', auth()->user()->company->id)
            ->where('deleted_at', null)
            ->paginate(8);
        return view('company.job.list', compact('jobs'));
    }

    public function createJob()
    {
        $skills = Skill::all(['id', 'name']);
        $levels = Level::all(['id', 'name']);
        $salaries = Salary::all(['id', 'salary']);
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        return view('company.job.create', compact('skills', 'salaries', 'address', 'levels'));
    }

    public function storeJob(JobCreateRequest $request)
    {
        try {
            $data = $request->only(['title', 'salary_id', 'describe', 'quantity', 'address_id', 'deadline']);
            $data['title'] = mb_strtoupper($data['title'], 'UTF-8');
            $data['company_id'] = auth()->user()->company->id;
            $data['status'] = 0;
            $data['deadline'] = date("Y-m-d", strtotime($data['deadline']));
            $job = Job::create($data);
            $job->skills()->sync($request->skills_id);
            $job->levels()->sync($request->levels_id);
            return redirect()->route('companies.index')->with('message', 'Đăng tin tuyển dụng thành công. Chúng tôi sẽ duyệt trong thời gian sớm nhất.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Đăng tin tuyển dụng thất bại. Vui lòng thử lại.');
        }
    }

    public function showJob($id)
    {
        $job = Job::find($id);
        return view('company.job.show', compact('job'));
    }

    public function editJob($id)
    {
        $job = Job::find($id);
        $skills = Skill::all(['id', 'name']);
        $oldSkills = $job->skills->pluck('id')->toArray();
        $levels = Level::all(['id', 'name']);
        $oldLevels = $job->levels->pluck('id')->toArray();
        $salaries = Salary::all(['id', 'salary']);
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        return view('company.job.edit', compact('job', 'skills', 'salaries', 'address', 'levels', 'oldSkills', 'oldLevels'));
    }

    public function updateJob(JobCreateRequest $request, $id)
    {
        try {
            $data = $request->only(['title', 'salary_id', 'describe', 'quantity', 'address_id', 'deadline']);
            $data['title'] = mb_strtoupper($data['title'], 'UTF-8');
            $data['deadline'] = date("Y-m-d", strtotime($data['deadline']));
            $data['status'] = 0;
            $job = Job::find($id);
            $job->update($data);
            $job->skills()->sync($request->skills_id);
            $job->levels()->sync($request->levels_id);
            return redirect()->route('companies.index')->with('message', 'Cập nhật tin tuyển dụng thành công.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Đăng tin tuyển dụng thất bại. Vui lòng thử lại.');
        }
    }

    public function deleteJob($id)
    {
        $job = Job::find($id);
        $job->levels()->detach();
        $job->delete();
        return redirect()->route('companies.index')->with('message', 'Xóa tin tuyển dụng thành công');
    }

    public function listMember()
    {
        $members = Member::orderBy('id', 'desc')->paginate(8);
        return view('company.member.list', compact('members'));
    }

    public function showMember($id)
    {
        $member = Member::find($id);
        return view('company.member.show', compact('member'));
    }

    // Company managements
    public function showProfile()
    {
        $profile = auth()->user()->company;
        return view('company.profile', compact('profile'));
    }

    public function editProfile()
    {
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        $profile = auth()->user()->company;
        return view('company.edit', compact('profile', 'address'));
    }

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
