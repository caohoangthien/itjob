<?php

namespace App\Http\Controllers;

use App\Model\Address;
use App\Model\Skill;
use App\Model\Level;
use Auth;

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

        return view('site.index', compact('address', 'skills', 'levels'));
    }
}
