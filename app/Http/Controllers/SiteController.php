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
        $jobs = Job::where('check', Job::CHECKED)->where('status', Job::ACTIVE)->orderBy('id', 'desc')->limit(20)->get();

        $dataPoints = array(
            array("y" => 4, "label" => "Pineapple"),
            array("y" => 6, "label" => "Pears"),
            array("y" => 7, "label" => "Grapes"),
            array("y" => 5, "label" => "Lychee"),
            array("y" => 4, "label" => "Jackfruit")
        );

        return view('site.index', compact('address', 'skills', 'levels', 'jobs', 'dataPoints'));
    }
}
