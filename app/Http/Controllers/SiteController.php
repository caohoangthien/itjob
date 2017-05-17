<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Job;
use DB;

class SiteController extends Controller
{
    /**
     * Get home site
     */
    public function index()
    {
//        $data = DB::table('job_skill')->select(DB::raw('sum(quantity) as total, skill_id'))
//            ->groupBy('skill_id')
//            ->whereMonth('created_at', 5)
//            ->get();
//        dd($data);
        $address = Address::all();
        $jobs = Job::where('status', Job::ACTIVE)->where('deleted_at', null)->orderBy('id', 'desc')->limit(20)->get();

        return view('site.index', compact('address', 'jobs'));
    }

    /**
     * Get full job
     *
     * @return view
     */
    public function getFullJob()
    {
        $jobs = Job::all();
        return view('site.full-job', compact('jobs'));
    }
}
