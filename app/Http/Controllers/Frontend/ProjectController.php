<?php

namespace App\Http\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;


class ProjectController extends Controller
{
        public function index()
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $projects = Project::where('assigned_to_id', auth()->user()->id)->get();
        return view('frontend.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('frontend.projects.create');
    }

    public function store(Request $request)
    {
        //
    }
}
