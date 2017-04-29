<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{
    /**
     * Get home admin
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
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
    public function store(AdminRequest $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($action)
    {
        $profile = auth()->user()->admin;
        return view('admin.profile', compact('profile', 'action'));
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
        $action = '';
        $profile = auth()->user()->admin;
        return view('admin.profile', compact('profile'));
    }

    /**
     * Show the form for editing profile
     *
     * @return view
     */
    public function editProfile()
    {
        $action = 'edit';
        $profile = auth()->user()->admin;
        return view('admin.profile', compact('profile', 'action'));
    }
}
