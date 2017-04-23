<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Address;
use App\Model\Skill;
use App\Model\Account;
use App\Model\MemberSkill;
use App\Model\Member;
use App\Http\Requests\MemberRequest;

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

        return view('member.create', compact('skills', 'address'));
    }

    /**
     * Post form signup
     *
     * @return redirect
     */
    public function postSignup(MemberRequest $request)
    {
        $account = new Account;
        $account->email = $request->email;
        $account->password = bcrypt($request->password);
        $account->role = '3';

        if($account->save()){
            $member = new Member;
            $member->account_id = $account->id;
            $member->name = $request->name;
            $member->address_id = $request->address_id;
            $member->phone = $request->phone;
            $member->about = $request->about;
            $member->gender = $request->gender;
            $member->birthday = $request->birthday;

            $path_image = "images/avatars/";
            $path_cv = "file/cv/";
            $nameImage = str_random('10') . time() . '.' . $request->avatar->getClientOriginalExtension();
            $nameCV = str_random('10') . time() . '.' . $request->cv->getClientOriginalExtension();
            $request->avatar->move($path_image, $nameImage);
            $request->cv->move($path_cv, $nameCV);
            $member->avatar = $path_image . $nameImage;
            $member->cv = $path_cv . $nameCV;

            if ($member->save()) {
                foreach ($request->skills_id as $id) {
                    $memberSkill = new MemberSkill;
                    $memberSkill->member_id = $member->id;
                    $memberSkill->skill_id = $id;
                    $memberSkill->save();
                }

                if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
                    return redirect()->route('home-manager');
                }else return back()->with('errorSystem', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
            }else return back()->with('errorSystem', 'Lỗi hệ thống. Vui lòng đăng kí lại !');
        }
    }
}
