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
use Datetime;

class JobController extends Controller
{
    /**
     * Show home page
     */
    public function index()
    {
        //
    }

    /**
     * Show form create job
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
     * Store job
     */
    public function store(JobCreateRequest $request)
    {
        try {
            $data = $request->only(['title', 'salary_id', 'describe', 'quantity', 'address_id', 'deadline']);
            $data['title'] = mb_strtoupper($data['title'], 'UTF-8');
            $data['company_id'] = auth()->user()->company->id;
            $data['status'] = 0;
            $data['deadline'] = date("Y-m-d", strtotime($data['deadline']));
            $job = Job::create($data);
            $job->skills()->sync($request->skills_id);
            $job->levels()->sync($request->levels_id);
            return redirect()->route('companies.index')->with('success', 'Đăng tin tuyển dụng thành công. Chúng tôi sẽ duyệt trong thời gian sớm nhất.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Đăng tin tuyển dụng thất bại. Vui lòng thử lại.');
        }
    }

    /**
     * Show job
     */
    public function show($id)
    {
        $job = Job::find($id);
        return view('job.show', compact('job'));
    }

    /**
     * Show edit job
     */
    public function edit($id)
    {
        $job = Job::find($id);
        $skills = Skill::all(['id', 'name']);
        $oldSkills = $job->skills->pluck('id')->toArray();
        $levels = Level::all(['id', 'name']);
        $oldLevels = $job->levels->pluck('id')->toArray();
        $salaries = Salary::all(['id', 'salary']);
        $address = Address::all(['id', 'name'])->pluck('name', 'id');
        return view('job.edit', compact('job', 'skills', 'salaries', 'address', 'levels', 'oldSkills', 'oldLevels'));
    }

    /**
     * Update job
     */
    public function update(JobCreateRequest $request, $id)
    {
        try {
            $data = $request->only(['title', 'salary_id', 'describe', 'quantity', 'address_id', 'deadline']);
            $data['title'] = mb_strtoupper($data['title'], 'UTF-8');
            $data['deadline'] = date("Y-m-d", strtotime($data['deadline']));
            $job = Job::find($id);
            $job->update($data);
            $job->skills()->sync($request->skills_id);
            $job->levels()->sync($request->levels_id);
            return redirect()->route('companies.index')->with('success', 'Cập nhật tin tuyển dụng thành công.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Đăng tin tuyển dụng thất bại. Vui lòng thử lại.');
        }
    }

    /**
     * Soft delete job
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        $job->levels()->detach();
        $job->delete();
        return redirect()->route('companies.index')->with('success', 'Xóa tin tuyển dụng thành công');
    }



    public function search(Request $request)
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

        return view('job.full-job', compact('jobs', 'address_array', 'skills', 'levels', 'salaries'));
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

    public function updateStatus($id) {
        $job = Job::find($id);
        if ($job->status == 0) {
            $data['status'] = 1;
        } else {
            $data['status'] = 0;
        }
        $job->update($data);
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Get full job
     *
     * @return view
     */
    public function getFullJob()
    {
        $jobs = Job::where('status', Job::ACTIVE)->paginate(8);
        $skills = Skill::all(['id', 'name']);
        $levels = Level::all(['id', 'name']);
        $salaries = Salary::all(['id', 'salary']);
        $address_array = Address::all(['id', 'name'])->pluck('name', 'id');

        return view('job.full-job', compact('jobs', 'address_array', 'skills', 'levels', 'salaries'));
    }

    public function searchTitle($id) {
        $skills = Skill::all(['id', 'name']);
        $levels = Level::all(['id', 'name']);
        $salaries = Salary::all(['id', 'salary']);
        $address_array = Address::all(['id', 'name'])->pluck('name', 'id');
        $job = Job::where('id', $id)->first();
        return view('job.job-info', compact('job', 'address_array', 'skills', 'levels', 'salaries'));
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
