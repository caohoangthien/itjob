<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Skill;
use App\Models\Level;
use App\Models\Job;

class SiteController extends Controller
{
    /**
     * Get home site
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Address::all();
        $skills = Skill::all();
        $levels = Level::all();
        $jobs = Job::where('check', Job::CHECKED)->where('status', Job::ACTIVE)->orderBy('id', 'desc')->limit(5)->get();

        return view('site.index', compact('address', 'skills', 'levels', 'jobs'));
    }
}
