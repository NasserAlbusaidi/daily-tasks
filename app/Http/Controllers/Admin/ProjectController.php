<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyProjectRequest;
use App\Models\Project;
use App\Models\ProjectOwner;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\ProjectUser;
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
        $projects = Project::with(['media'])->where('status_id', '!=', 3)->get();
        //get owner name
        // $projects->map(function($project){
        //     $project->owner_name = $project->owner_name->name;
        //     return $project;
        // });
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        abort_if(Gate::denies('project_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $assigned_to = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $project_owner = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        //get users with role engineer
        $engineer_owner = User::whereHas('roles', function($q){
            $q->where('title', 'Engineer');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.projects.create', compact('statuses', 'assigned_to', 'engineer_owner', 'project_owner'));
    }

    public function edit(Project $project)
    {
        abort_if(Gate::denies('project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $project->load('status', 'owner_name');
        $statuses = TaskStatus::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $project_owner = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $engineer_owner = User::whereHas('roles', function($q){
            $q->where('title', 'engineer');
        })->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $assigned_tos = ProjectUser::where('project_id', $project->id)->get();
        $users = User::get();
        $assigned_users = $users->whereIn('id', $assigned_tos->pluck('user_id'));
        return view('admin.projects.edit', compact('project', 'statuses', 'assigned_users', 'project_owner', 'engineer_owner', 'users'));
    }

    public function update(Request $request, Project $project) {
       $project->update(
              [
                'title' => $request->title,
                'estimation_cost' => 250,
                'actual_cost' => $request->actual_cost,
                'engineer_owner' => $request->engineer_owner,
                'status_id' => $request->status_id,
                'project_owner' => $request->project_owner,
                'vote_number' => $request->vote_number,
              ]
       );
        foreach($project->assigned_tos as $user){
            $projectUser = ProjectUser::where('project_id', $project->id)->where('user_id', $user->id)->first();
            $projectUser->delete();
        }
        foreach($request->assigned_tos_id as $user){
            $projectUser = new ProjectUser();
            $projectUser->project_id = $project->id;
            $projectUser->user_id = $user;
            $projectUser->save();
        }
       if($request->input('pdf_attachment', false)){
           if(!$project->pdf || $request->input('pdf_attachment') !== $project->pdf->file_name){
               if($project->pdf){
                   $project->pdf->delete();
               }
               $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('pdf_attachment'))))->toMediaCollection('pdf_attachment');
           }
         }elseif($project->pdf){
                $project->pdf->delete();
            }
        if($request->input('excel_attachment', false)){
            if(!$project->excel || $request->input('excel_attachment') !== $project->excel->file_name){
                if($project->excel){
                    $project->excel->delete();
                }
                $project->addMedia(storage_path('tmp/uploads/' . basename($request->input('excel_attachment'))))->toMediaCollection('excel_attachment');
            }
        }elseif($project->excel){
            $project->excel->delete();
        }
        return redirect()->route('admin.projects.index');
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
            'project_owner' => $request->project_owner,
            'vote_number' => $request->vote_number,


        ]);
        foreach($request->assigned_to_id as $user){
            $projectUser = new ProjectUser();
            $projectUser->project_id = $project->id;
            $projectUser->user_id = $user;
            $projectUser->save();
        }

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

    public function massDestroy(MassDestroyProjectRequest $request)
    {
       $project = Project::find(request('ids'));

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

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('project_create') && Gate::denies('project_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Project();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

}
