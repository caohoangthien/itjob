<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminUpdateRequest;
use App\Models\Account;
use App\Models\Admin;

class AdminController extends Controller
{
    /**
     * Get home admin
     *
     * @return view
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show profile
     *
     * @return view
     */
    public function showProfile()
    {
        $profile = auth()->user()->admin;
        return view('admin.show', compact('profile'));
    }

    /**
     * Edit profile
     *
     * @return view
     */
    public function editProfile()
    {
        $profile = auth()->user()->admin;
        return view('admin.edit', compact('profile'));
    }

    /**
     * Update profile
     *
     * @return view
     */
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
        Admin::find(auth()->id())->update($data);

        return response()->json([
            'message' => 'Success',
            'fileName' => $data['avatar'],
        ]);
    }
}