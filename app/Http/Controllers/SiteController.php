<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Job;
use App\Models\Skill;
use App\Models\Level;
use App\Models\Salary;
use App\Models\JobSkill;
use Illuminate\Http\Request;
use Datetime;
use DB;

class SiteController extends Controller
{
    /**
     * Get home site
     */
    public function index()
    {
        $address = Address::all();
        $skills = Skill::all(['id', 'name']);
        $levels = Level::all(['id', 'name']);
        $salaries = Salary::all(['id', 'salary']);
        $address_array = Address::all(['id', 'name'])->pluck('name', 'id');
        $jobs = Job::where('status', Job::ACTIVE)->where('deleted_at', null)->orderBy('id', 'desc')->limit(20)->get();
        $jobSkills = DB::table('job_skill')
            ->join('jobs', 'jobs.id', '=', 'job_skill.job_id')
            ->select('job_skill.skill_id as idSkill', DB::raw('sum(jobs.quantity) as quantity'))
            ->groupBy('job_skill.skill_id')
            ->whereMonth('job_skill.created_at', 5)
            ->whereYear('job_skill.created_at', 2017)
            ->get();
        $chart = [];
        if ($jobSkills->count() > 0) {
            foreach ($jobSkills as $jobSkill) {
                $skill['y'] = $jobSkill->quantity;
                $skill['label'] = $this->getNameSkill($jobSkill->idSkill);
                $chart[] = $skill;
            }
        }
        return view('site.index', compact('address', 'jobs', 'address_array', 'skills', 'levels', 'salaries', 'chart'));
    }

    /**
     * Get name skill
     *
     * @return name
     */
    public function getNameSkill($id) {
        return Skill::find($id)->name;
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

    public function getChart(Request $request) {
        $month = DateTime::createFromFormat('m-Y', $request->yearMonth)->format('m');
        $year = DateTime::createFromFormat('m-Y', $request->yearMonth)->format('Y');
        $jobSkills = DB::table('job_skill')
            ->join('jobs', 'jobs.id', '=', 'job_skill.job_id')
            ->select('job_skill.skill_id as idSkill', DB::raw('sum(jobs.quantity) as quantity'))
            ->groupBy('job_skill.skill_id')
            ->whereMonth('job_skill.created_at', $month)
            ->whereYear('job_skill.created_at', $year)
            ->get();
        $chart = [];
        if ($jobSkills->count() > 0) {
            foreach ($jobSkills as $jobSkill) {
                $skill['y'] = (int)$jobSkill->quantity;
                $skill['label'] = $this->getNameSkill($jobSkill->idSkill);
                $chart[] = $skill;
            }
        }

        return response()->json($chart);
    }
}
