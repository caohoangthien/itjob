<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Skill;
use App\Models\Account;
use App\Models\MemberSkill;
use App\Models\Member;
use App\Http\Requests\MemberCreateRequest;
use App\Http\Requests\MemberUpdateRequest;

class MemberController extends Controller
{
    public function getSignup()
    {
        $skills = Skill::all(['id', 'name']);
        $address = Address::all(['id', 'name'])->pluck('name', 'id');

        return view('member.signup', compact('skills', 'address'));
    }

    public function postSignup(MemberCreateRequest $request)
    {
        try {
            $dataAccount = $request->only('email', 'password');
            $dataAccount['password'] = bcrypt($dataAccount['password']);
            $dataAccount['role'] = Account::MEMBER;
            $account = Account::create($dataAccount);

            $dataMember = $request->only('name', 'address_id', 'phone', 'about', 'gender', 'birthday');
            $dataMember['account_id'] = $account->id;
            $nameImage = str_random('20') . time() . '.' . $request->avatar->getClientOriginalExtension();
            $nameCV = str_random('20') . time() . '.' . $request->cv->getClientOriginalExtension();
            $request->avatar->move(Member::PATH_AVATAR, $nameImage);
            $request->cv->move(Member::PATH_CV, $nameCV);
            $dataMember['avatar'] = Member::PATH_AVATAR . $nameImage;
            $dataMember['cv'] = Member::PATH_CV . $nameCV;
            $member = Member::create($dataMember);
            $member->skills()->sync($request->skills_id);

            if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('members.index');
            }else return back()->with('error', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        } catch (\Exception $ex) {
            return back()->withInput()->with('error', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        }
    }

    public function index()
    {
        $profile = auth()->user()->member;
        foreach ($profile->skills as $skill) {
            $skills[] = $skill->id;
        }
        $jobs = Job::where('status', Job::ACTIVE)->whereHas('skills', function ($query) use ($skills) {
            $query->whereIn('skills.id', $skills);
        })->paginate(15);

        return view('member.index', compact('jobs'));
    }

    public function showProfile()
    {
        $profile = auth()->user()->member;
        return view('member.profile', compact('profile'));
    }

    public function updateImage(Request $request)
    {
        unlink($request->oldImage);
        $path = "images/avatars/";
        $fileName = str_random('10') . time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move($path, $fileName);
        $data['avatar'] = $path . $fileName;
        Member::where('account_id', auth()->id())->first()->update($data);

        return response()->json([
            'message' => 'Success',
            'fileName' => $data['avatar'],
        ]);
    }

    public function editProfile()
    {
        $profile = auth()->user()->member;
        $skills = Skill::all(['id', 'name']);
        $oldSkill = $profile->skills->pluck('id')->toArray();
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        return view('member.edit', compact('profile', 'address', 'skills', 'oldSkill'));
    }

    public function updateProfile(MemberUpdateRequest $request)
    {
        $account = Account::find(auth()->id());
        $member = Member::where('account_id', $account->id);
        $dataAccount = $request->only(['email']);
        if ($request->password) {
            $dataAccount['password'] = bcrypt($request->password);
        }
        $dataMember = $request->only(['name', 'address_id', 'phone', 'gender', 'about']);
        if ($account->update($dataAccount) && $member->update($dataMember) && $account->member->skills()->sync($request->skills_id)) {
            return redirect()->route('members.profile.show')->with('success', 'Cập nhật thông tin cá nhân thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thông tin cá nhân thất bại');
        }
    }

    public function showJob($id) {
        $job = Job::find($id);
        return view('member.job.show', compact('job'));
    }
}