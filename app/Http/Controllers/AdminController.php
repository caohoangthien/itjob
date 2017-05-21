<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Account;
use App\Models\Admin;
use App\Models\Job;
use App\Models\Member;
use App\Models\Contact;
use App\Models\Company;

class AdminController extends Controller
{
    public function index()
    {
        $jobs = Job::orderBy('id', 'desc')
            ->orderBy('status', 'asc')
            ->paginate(9);
        return view('admin.list-job', compact('jobs'));
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

    public function listJob()
    {
        $jobs = Job::orderBy('id', 'desc')
            ->orderBy('status', 'asc')
            ->paginate(9);
        return view('admin.list-job', compact('jobs'));
    }

    public function showJob($id)
    {
        $job = Job::find($id);
        return view('admin.show-job', compact('job'));
    }

    public function deleteJob($id)
    {
        Job::find($id)->delete();
        return redirect()->route('admins.index')->with('message', 'Xóa công việc thành công.');
    }

    public function showMember($id)
    {
        $member = Member::find($id);
        return view('admin.show-member', compact('member'));
    }

    public function listContact()
    {
        $contacts = Contact::paginate(9);

        return view('contact.list', compact('contacts'));
    }

    public function showContact($id)
    {
        $contact = Contact::find($id);

        return view('contact.show', compact('contact'));
    }

    public function deleteContact($id)
    {
        $delete = Contact::find($id)->delete();
        if ($delete) {
            return redirect()->route('contacts.list')->with('message', 'Xóa thành công');
        }
    }

    public function updateStatus($id) {
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

    public function listCompany()
    {
        $companies = Company::orderBy('id', 'desc')->paginate(15);

        return view('admin.list-company', compact('companies'));
    }

    public function showCompany($id)
    {
        $company = Company::find($id);
        return view('admin.show-company', compact('company'));
    }
}