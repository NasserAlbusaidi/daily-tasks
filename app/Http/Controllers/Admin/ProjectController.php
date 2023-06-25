<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Project;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProjectController extends Controller
{

    use MediaUploadingTrait;
    public function index(Project $project)
    {
        abort_if(Gate::denies('project_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $projects = $project->all( );
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assigned_to = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        //get user role


        //get users with role engineer
        $engineer_owner = User::whereHas('roles', function($q){
            $q->where('title', 'engineer');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.projects.create', compact('statuses', 'assigned_to', 'engineer_owner'));
    }

    public function store(Request $request)
    {
        $project = Project::create($request->all());
        if($request->input('attachment', false)){
            $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('attachment'))))->toMediaCollection('attachment');
        }
        if($media = $request->input('ck-media', false)){
            Media::whereIn('id', $media)->update(['model_id' => $project->id]);
        }
        dd($project);
        return redirect()->route('admin.projects.index');
    }

}
