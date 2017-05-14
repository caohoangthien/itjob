<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Job;

class SiteController extends Controller
{
    /**
     * Get home site
     */
    public function index()
    {
        $address = Address::all();
        $jobs = Job::where('status', Job::ACTIVE)->where('deleted_at', null)->orderBy('id', 'desc')->limit(20)->get();

        $dataPoints = array(
            array("y" => 4, "label" => "Pineapple"),
            array("y" => 6, "label" => "Pears"),
            array("y" => 7, "label" => "Grapes"),
            array("y" => 5, "label" => "Lychee"),
            array("y" => 4, "label" => "Jackfruit")
        );

        return view('site.index', compact('address', 'jobs', 'dataPoints'));
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
