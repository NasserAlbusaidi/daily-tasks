<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\Project;
use App\Models\ProjectOwner;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Gate;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ProjectOwnerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $owners = ProjectOwner::all();


        return view('admin.projectOwners.index', compact('owners'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');
        $projects = Project::where('project_owner', null)->pluck('title', 'id');
        return view('admin.projectOwners.create', compact('users', 'projects'));
    }

    public function store(Request $request)
    {
        $owner = ProjectOwner::create($request->all());
        $owner->name = User::where('id', $request->user_id)->pluck('name')->first();
        $owner->save();

        return redirect()->route('admin.project-owners.index');
    }

    public function edit( $id)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $owner = ProjectOwner::findOrFail($id);
        $users = User::all()->pluck('name', 'id');
        $projects = Project::where('project_owner', null)->pluck('title', 'id');
        return view('admin.projectOwners.edit', compact('users', 'projects', 'owner'));
    }

    public function update(Request $request, $id)
    {
        $owner = ProjectOwner::findOrFail($id);
        $owner->update($request->all());
        $owner->name = User::where('id', $request->user_id)->pluck('name')->first();
        $owner->save();
        return redirect()->route('admin.project-owners.index');
    }

    public function show(ProjectOwner $owner, $id)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $owner = ProjectOwner::findOrFail($id);
        return view('admin.projectOwners.show', compact('owner'));
    }

    public function destroy(ProjectOwner $owner, $id)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $owner->where('id', $id)->delete();

        return back();
    }
}
