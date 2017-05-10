<?php

namespace App\Http\Controllers;

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('member.index');
    }

    /**
     * List company
     *
     * @return view
     */
    public function list()
    {
        $members = Member::orderBy('id', 'desc')->paginate(15);
        return view('member.list', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Get form signup
     *
     * @return view
     */
    public function getSignup()
    {
        $skills = Skill::all(['id', 'name']);
        $address = Address::all(['id', 'name'])->pluck('name', 'id');

        return view('member.signup', compact('skills', 'address'));
    }

    /**
     * Post form signup
     *
     * @return redirect
     */
    public function postSignup(MemberCreateRequest $request)
    {
        try {
            $dataAccount = $request->only('email', 'password');
            $dataAccount['password'] = bcrypt($dataAccount['password']);
            $dataAccount['role'] = 3;
            $account = Account::create($dataAccount);
            $dataMember = $request->only('name', 'address_id', 'phone', 'about', 'gender', 'birthday');
            $dataMember['account_id'] = $account->id;
            $path_image = "images/avatars/";
            $path_cv = "file/cv/";
            $nameImage = str_random('20') . time() . '.' . $request->avatar->getClientOriginalExtension();
            $nameCV = str_random('20') . time() . '.' . $request->cv->getClientOriginalExtension();
            $request->avatar->move($path_image, $nameImage);
            $request->cv->move($path_cv, $nameCV);
            $dataMember['avatar'] = $path_image . $nameImage;
            $dataMember['cv'] = $path_cv . $nameCV;
            $member = Member::create($dataMember);
            foreach ($request->skills_id as $skill_id) {
                $memberSkill = ['member_id' => $member->id, 'skill_id' => $skill_id];
                MemberSkill::create($memberSkill);
            }
            if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
                return redirect()->route('members.index');
            }else return back()->with('error', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        } catch (\Exception $ex) {
            return back()->withInput()->with('error', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        }
    }

    /**
     * Show profile
     *
     * @return view
     */
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

    /**
     * Edit profile
     *
     * @return view
     */
    public function editProfile()
    {
        $profile = auth()->user()->member;
        $skills = Skill::all(['id', 'name']);
        $oldSkill = $profile->skills->pluck('id')->toArray();
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        return view('member.edit', compact('profile', 'address', 'skills', 'oldSkill'));
    }

    /**
     * Update profile
     *
     * @return view
     */
    public function updateProfile(MemberUpdateRequest $request)
    {
        $account = Account::find(auth()->id());
        $member = Member::where('account_id', $account->id);
        $dataAccount = $request->only(['email']);
        if ($request->password) {
            $dataAccount['password'] = bcrypt($request->password);
        }
        $dataMember = $request->only(['name', 'address_id', 'phone', 'gender', 'birthday', 'about']);
        if ($account->update($dataAccount) && $member->update($dataMember)) {
            return redirect()->route('members.profile.show')->with('success', 'Cập nhật thông tin cá nhân thành công');
        } else {
            return redirect()->back()->with('error', 'Cập nhật thông tin cá nhân thất bại');
        }
    }
}