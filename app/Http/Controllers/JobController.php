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
        try {
            $data = $request->only(['title', 'salary_id', 'quantity', 'describe', 'address_id', 'status']);
            $data['title'] = mb_strtoupper($data['title'], 'UTF-8');
            $data['company_id'] = auth()->user()->company->id;
            $data['check'] = 0;
            $job = Job::create($data);
            $job->skills()->sync($request->skills_id);
            $job->levels()->sync($request->levels_id);
            return redirect()->route('companies.index')->with('success', 'Đăng tin tuyển dụng thành công. Chúng tôi sẽ duyệt trong thời gian sớm nhất.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Đăng tin tuyển dụng thất bại. Vui lòng thử lại.');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $job = Job::find($id);
        return view('job.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JobCreateRequest $request, $id)
    {
        try {
            $data = $request->only(['title', 'salary_id', 'quantity', 'describe', 'address_id', 'status']);
            $data['title'] = mb_strtoupper($data['title'], 'UTF-8');
            $job = Job::find($id);
            $job->update($data);
            $job->skills()->sync($request->skills_id);
            $job->levels()->sync($request->levels_id);
            return redirect()->route('companies.index')->with('success', 'Cập nhật tin tuyển dụng thành công. Chúng tôi sẽ duyệt trong thời gian sớm nhất.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', 'Đăng tin tuyển dụng thất bại. Vui lòng thử lại.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Job::find($id)->delete();
        return redirect()->route('companies.index')->with('success', 'Xóa tin tuyển dụng thành công');
    }

    public function listUncheck()
    {
        $jobs = Job::where('check', Job::UNCHECK)->where('company_id', auth()->user()->company->id)->paginate(15);
        return view('job.list', compact('jobs'));
    }

    public function listChecked()
    {
        $jobs = Job::where('check', Job::CHECKED)->where('company_id', auth()->user()->company->id)->paginate(15);
        return view('job.list', compact('jobs'));
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
}
