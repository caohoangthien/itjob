<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminUpdateRequest;
use App\Http\Requests\SkillRequest;
use App\Models\Account;
use App\Models\Admin;
use App\Models\Job;
use App\Models\Member;
use App\Models\Contact;
use App\Models\Company;
use App\Models\Skill;

class AdminController extends Controller
{
    public function index()
    {
        return redirect()->route('admins.job.list');
    }

    public function showProfile()
    {
        $profile = auth()->user()->admin;
        return view('admin.profile', compact('profile'));
    }

    public function editProfile()
    {
        $profile = auth()->user()->admin;
        return view('admin.edit', compact('profile'));
    }

    public function updateProfile(AdminUpdateRequest $request)
    {
        $account = Account::find(auth()->id());
        $admin = Admin::where('account_id', $account->id);
        $dataAccount = $request->only(['email']);
        if ($request->password) {
            $dataAccount['password'] = bcrypt($request->password);
        }
        $dataAdmin = $request->only(['name']);
        if ($account->update($dataAccount) && $admin->update($dataAdmin)) {
            return redirect()->route('admins.profile.show')->with('success', 'Cập nhật thông tin cá nhân thành công');
        } else {
            return redirect()->back()->withInput()->with('error', 'Cập nhật thông tin cá nhân thất bại');
        }
    }

    public function updateImage(Request $request)
    {
        unlink($request->oldImage);
        $path = "images/avatars/";
        $fileName = str_random('10') . time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move($path, $fileName);
        $data['avatar'] = $path . $fileName;
        Admin::where('account_id', auth()->id())->first()->update($data);

        return response()->json([
            'message' => 'Success',
            'fileName' => $data['avatar'],
        ]);
    }

    // Contact management
    public function listContact()
    {
        $contacts = Contact::paginate(8);
        return view('admin.contact.list', compact('contacts'));
    }

    public function showContact($id)
    {
        $contact = Contact::find($id);
        return view('admin.contact.show', compact('contact'));
    }

    public function deleteContact($id)
    {
        $delete = Contact::find($id)->delete();
        if ($delete) {
            return redirect()->route('admins.contact.list')->with('message', 'Xóa thành công');
        }
    }

    // Skill management
    public function listSkill()
    {
        $skills = Skill::paginate(7);
        return view('admin.skill.list', compact('skills'));
    }

    public function createSkill()
    {
        return view('admin.skill.create');
    }

    public function storeSkill(SkillRequest $request)
    {
        $data['name'] = $request->name;
        $skill = Skill::create($data);
        if ($skill) {
            return redirect()->route('admins.skill.list')->with('message', 'Thêm kỹ năng thành công.');
        }
    }

    public function editSkill($id)
    {
        $skill = Skill::find($id);
        return view('admin.skill.edit', compact('skill'));
    }

    public function updateSkill(SkillRequest $request, $id)
    {
        $data['name'] = $request->name;
        $skill = Skill::find($id)->update($data);
        if ($skill) {
            return redirect()->route('admins.skill.list')->with('message', 'Cập nhật kỹ năng thành công.');
        }
    }

    public function deleteSkill($id)
    {
        $skill = Skill::find($id);
        $skill->members()->detach();
        $skill->delete();
        return redirect()->route('admins.skill.list')->with('message', 'Xóa kỹ năng thành công.');
    }

    // Member management
    public function listMember()
    {
        $members = Member::orderBy('id', 'desc')->paginate(15);
        return view('admin.member.list', compact('members'));
    }

    public function showMember($id)
    {
        $member = Member::find($id);
        return view('admin.member.show', compact('member'));
    }

    public function deleteMember($id)
    {
        unlink(Member::find($id)->avatar);
        $member = Member::find($id);
        $member->account()->delete();
        $member->skills()->detach();
        $member->delete();
        return redirect()->route('admins.member.list')->with('message', 'Xóa thành viên thành công.');
    }

    //Job management
    public function listJob()
    {
        $jobs = Job::orderBy('id', 'desc')
            ->orderBy('status', 'asc')
            ->paginate(9);
        return view('admin.job.list', compact('jobs'));
    }

    public function updateJobStatus($id) {
        $job = Job::find($id);
        if ($job->status == 0) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $job->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function showJob($id)
    {
        $job = Job::find($id);
        return view('admin.job.show', compact('job'));
    }

    public function deleteJob($id)
    {
        $job = Job::find($id);
        $job->levels()->detach();
        $job->delete();
        return redirect()->route('admins.job.list')->with('message', 'Xóa công việc thành công.');
    }

    // Company management
    public function listCompany()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(15);
        return view('admin.company.list', compact('companies'));
    }

    public function showCompany($id)
    {
        $company = Company::find($id);
        return view('admin.company.show', compact('company'));
    }

    public function deleteCompany($id)
    {
        unlink(Company::find($id)->avatar);
        $company = Company::find($id);
        foreach ($company->jobs as $job) {
            $job->levels()->detach();
        }
        $company->jobs()->delete();
        $company->account()->delete();
        $company->delete();
        return redirect()->route('admins.company.list')->with('message', 'Xóa công ty thành công.');
    }
}