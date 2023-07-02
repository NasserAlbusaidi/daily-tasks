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
        return view('admin.projectOwners.create');
    }

    public function store(Request $request)
    {
        $owner = ProjectOwner::create($request->all());

        return redirect()->route('admin.project-owners.index');
    }

    public function edit( $id)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $owner = ProjectOwner::findOrFail($id);
        return view('admin.projectOwners.edit', compact('owner'));
    }

    public function update(Request $request, $id)
    {
        $owner = ProjectOwner::findOrFail($id);
        $owner->update($request->all());
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
