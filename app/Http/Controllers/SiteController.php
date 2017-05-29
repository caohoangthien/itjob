<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Job;
use App\Models\Skill;
use App\Models\Level;
use App\Models\Salary;
use App\Models\Contact;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use Datetime;
use DB;

class SiteController extends Controller
{
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
            ->where('status', Job::ACTIVE)
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

    public function getNameSkill($id) {
        return Skill::find($id)->name;
    }

    public function contact() {
        return view('contact.index');
    }

    public function storeContact(ContactRequest $request) {
        $data = $request->only(['name', 'email', 'content']);
        $contact = Contact::create($data);
        if ($contact) {
            return redirect()->route('contact')->with('message', 'Thông tin được gởi thành công. Xin cảm ơn !');
        }
    }

    public function showCompany($id) {
        $company = Company::find($id);
        $skills = Skill::all(['id', 'name']);
        $levels = Level::all(['id', 'name']);
        $salaries = Salary::all(['id', 'salary']);
        $address_array = Address::all(['id', 'name'])->pluck('name', 'id');

        return view('site.company.company-infor', compact('company', 'address_array', 'skills', 'levels', 'salaries'));
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

    public function searchJob(Request $request)
    {
        $skills = Skill::all(['id', 'name']);
        $levels = Level::all(['id', 'name']);
        $salaries = Salary::all(['id', 'salary']);
        $address_array = Address::all(['id', 'name'])->pluck('name', 'id');
        $jobs = Job::with(['company' => function ($query) { $query->select(['id', 'name']); }])
            ->with(['address' => function ($query) { $query->select(['id', 'name']); }])
            ->with(['salary' => function ($query) { $query->select(['id', 'salary']); }])
            ->select(['id', 'company_id', 'address_id', 'salary_id', 'title', 'created_at'])
            ->get();

        if ($request->title) {
            $results = Job::with(['company' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['address' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['salary' => function ($query) { $query->select(['id', 'salary']); }])
                ->select(['id', 'company_id', 'address_id', 'salary_id', 'title', 'created_at'])
                ->where('title', 'like', '%'. $request->title .'%')
                ->get();
            $jobs = $jobs->intersect($results);
        }

        if ($request->company) {
            $results = Job::with(['company' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['address' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['salary' => function ($query) { $query->select(['id', 'salary']); }])
                ->select(['id', 'company_id', 'address_id', 'salary_id', 'title', 'created_at'])
                ->whereHas('company', function ($query) use ($request) {
                    $query->where('name', $request->company);
                })->get();
            $jobs = $jobs->intersect($results);
        }

        if ($request->address_id) {
            $results = Job::with(['company' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['address' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['salary' => function ($query) { $query->select(['id', 'salary']); }])
                ->select(['id', 'company_id', 'address_id', 'salary_id', 'title', 'created_at'])
                ->whereHas('address', function ($query) use ($request) {
                    $query->where('id', $request->address_id);
                })->get();
            $jobs = $jobs->intersect($results);
        }

        if ($request->skills_id) {
            $results = Job::with(['company' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['address' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['salary' => function ($query) { $query->select(['id', 'salary']); }])
                ->select(['id', 'company_id', 'address_id', 'salary_id', 'title', 'created_at'])
                ->whereHas('skills', function ($query) use ($request) {
                    $query->whereIn('skills.id', $request->skills_id);
                })->get();
            $jobs = $jobs->intersect($results);
        }

        if ($request->levels_id) {
            $results = Job::with(['company' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['address' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['salary' => function ($query) { $query->select(['id', 'salary']); }])
                ->select(['id', 'company_id', 'address_id', 'salary_id', 'title', 'created_at'])
                ->whereHas('levels', function ($query) use ($request) {
                    $query->whereIn('levels.id', $request->levels_id);
                })->get();
            $jobs = $jobs->intersect($results);
        }

        if ($request->salary_id) {
            $results = Job::with(['company' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['address' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['salary' => function ($query) { $query->select(['id', 'salary']); }])
                ->select(['id', 'company_id', 'address_id', 'salary_id', 'title', 'created_at'])
                ->whereHas('salary', function ($query) use ($request) {
                    $query->where('salaries.id', $request->salary_id);
                })->get();
            $jobs = $jobs->intersect($results);
        }

        $message = '';
        if ($jobs->count() > 0){
            return view('site.job.result-search', compact('jobs', 'address_array', 'skills', 'levels', 'salaries', 'message'));
        } else {
            $message = 'Không tìm thấy kết quả.';
            return view('site.job.result-search', compact('jobs', 'address_array', 'skills', 'levels', 'salaries', 'message'));
        }


    }

    public function searchAjax(Request $request)
    {
        $noResult = collect(new Job);
        if (($request['title'] == null) && ($request['company'] == null) && ($request['address_id'] == null)) {
            return response()->json($noResult);
        } else {
            $results = Job::with(['company' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['address' => function ($query) { $query->select(['id', 'name']); }])
                ->with(['salary' => function ($query) { $query->select(['id', 'salary']); }])
                ->select(['id', 'company_id', 'address_id', 'salary_id', 'title', 'created_at'])
                ->get();
            if ($request['title']) {
                $jobs = Job::with(['company' => function ($query) { $query->select(['id', 'name']); }])
                    ->with(['address' => function ($query) { $query->select(['id', 'name']); }])
                    ->with(['salary' => function ($query) { $query->select(['id', 'salary']); }])
                    ->select(['id', 'company_id', 'address_id', 'salary_id', 'title', 'created_at'])
                    ->where('title', 'like', '%'. $request['title'] .'%')
                    ->get();
                $results = $results->intersect($jobs);
            }

            if ($request['company']) {
                $jobs = Job::with(['company' => function ($query) { $query->select(['id', 'name']); }])
                    ->with(['address' => function ($query) { $query->select(['id', 'name']); }])
                    ->with(['salary' => function ($query) { $query->select(['id', 'salary']); }])
                    ->select(['id', 'company_id', 'address_id', 'salary_id', 'title', 'created_at'])
                    ->where('title', 'like', '%'. $request['title'] .'%')
                    ->whereHas('company', function ($query) use ($request) {
                        $query->where('name', 'like', '%'. $request['company'] .'%');
                    })->get();
                $results = $results->intersect($jobs);
            }

            if ($request['address_id']) {
                $jobs = Job::with(['company' => function ($query) { $query->select(['id', 'name']); }])
                    ->with(['address' => function ($query) { $query->select(['id', 'name']); }])
                    ->with(['salary' => function ($query) { $query->select(['id', 'salary']); }])
                    ->select(['id', 'company_id', 'address_id', 'salary_id', 'title', 'created_at'])
                    ->where('title', 'like', '%'. $request['title'] .'%')
                    ->whereHas('address', function ($query) use ($request) {
                        $query->where('id', $request['address_id']);
                    })->get();
                $results = $results->intersect($jobs);
            }
            return response()->json($results);
        }
    }

    public function getFullJob()
    {
        $jobs = Job::where('status', Job::ACTIVE)->paginate(8);
        $skills = Skill::all(['id', 'name']);
        $levels = Level::all(['id', 'name']);
        $salaries = Salary::all(['id', 'salary']);
        $address_array = Address::all(['id', 'name'])->pluck('name', 'id');

        return view('site.job.full-job', compact('jobs', 'address_array', 'skills', 'levels', 'salaries'));
    }

    public function searchTitle($id) {
        $skills = Skill::all(['id', 'name']);
        $levels = Level::all(['id', 'name']);
        $salaries = Salary::all(['id', 'salary']);
        $address_array = Address::all(['id', 'name'])->pluck('name', 'id');
        $job = Job::where('id', $id)->first();
        return view('site.job.job-info', compact('job', 'address_array', 'skills', 'levels', 'salaries'));
    }
}
