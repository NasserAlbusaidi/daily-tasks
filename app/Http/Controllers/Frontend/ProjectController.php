<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Gate;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class ProjectController extends Controller
{
        public function index()
    {
        abort_if(Gate::denies('task_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $projects = Project::whereHas('assigned_tos', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('assigned_tos')->get();
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
