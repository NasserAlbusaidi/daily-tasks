<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProjectTask;
use Illuminate\Http\Request;
use App\Models\Project;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class ProjectTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Project $project)
    {
        abort_if(Gate::denies('project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $project->load('status', 'owner_name');
        $tasks = ProjectTask::where('project_id', $project->id)->get();
        return view('admin.projects.tasks', compact('tasks', 'project'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProjectTask $projectTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProjectTask $projectTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProjectTask $projectTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProjectTask $projectTask)
    {
        //
    }

    // public function tasks(Project $project)
    // {
    //     abort_if(Gate::denies('project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     $project->load('status', 'owner_name');
    //     return view('admin.projects.show', compact('project'));
    // }
}
