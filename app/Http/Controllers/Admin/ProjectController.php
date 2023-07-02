<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\MassDestroyTaskRequest;
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
        abort_if(Gate::denies('project_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $projects = Project::with(['media'])->get();
        // dd($projects->first()->attachment);
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
        // dd($request->all());
        $project = Project::create([
            'title' => $request->title,
            'estimation_cost' => 250,
            'actual_cost' => $request->actual_cost,
            'engineer_owner' => $request->engineer_owner,
            'status_id' => $request->status_id,
            'assigned_to_id' => $request->assigned_to_id,
            'project_owner' => 2,
            'vote_number' => 0,


        ]);



        if($request->input('pdf_attachment', false)){
            $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('pdf_attachment'))))->toMediaCollection('pdf_attachment');
        }
        if($media = $request->input('ck-media', false)){
            Media::whereIn('id', $media)->update(['model_id' => $project->id]);
        }

        if($request->input('excel_attachment', false)){
            $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('excel_attachment'))))->toMediaCollection('excel_attachment');
        }
        if($media = $request->input('ck-media', false)){
            Media::whereIn('id', $media)->update(['model_id' => $project->id]);
        }
        // dd($project);
        return redirect()->route('admin.projects.index');
    }

    public function massDestroy(MassDestroyTaskRequest $request)
    {
       $project = Project::find(request('ids'));
        dd($project);
       foreach ($project as $key => $value) {
           $value->delete();
       }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function destroy($id)
    {
        abort_if(Gate::denies('project_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $project = Project::find($id);
        $project->delete();
        return back();
    }

}
