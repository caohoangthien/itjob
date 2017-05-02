<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\Salary;
use App\Models\Level;
use App\Models\Address;
use App\Models\JobSkill;
use App\Models\JobLevel;
use App\Http\Requests\JobCreateRequest;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $skills = Skill::all(['id', 'name']);
        $levels = Level::all(['id', 'name']);
        $salaries = Salary::all(['id', 'salary']);
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        return view('job.create', compact('skills', 'salaries', 'address', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JobCreateRequest $request)
    {
        $data = $request->only(['title', 'salary_id', 'quantity', 'describe', 'address_id']);
        $data['company_id'] = auth()->user()->company->id;
        $job = Job::create($data);
        foreach ($request->skills_id as $skill_id) {
            $jobskill = ['job_id' => $job->id, 'skill_id' => $skill_id];
            JobSkill::create($jobskill);
        }
        foreach ($request->levels_id as $level_id) {
            $joblevel = ['job_id' => $job->id, 'level_id' => $level_id];
            JobLevel::create($joblevel);
        }
        dd('asdadad');
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
}
