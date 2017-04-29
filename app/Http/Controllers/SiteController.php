<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Skill;
use App\Models\Level;

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
