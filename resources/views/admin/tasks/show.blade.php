@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.task.title') }}
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.tasks.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.id') }}
                            </th>
                            <td>
                                {{ $task->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.name') }}
                            </th>
                            <td>
                                {{ $task->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.description') }}
                            </th>
                            <td>
                                {{ $task->description }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.status') }}
                            </th>
                            <td>
                                {{ $task->status->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.tag') }}
                            </th>
                            <td>
                                @foreach ($task->tags as $key => $tag)
                                    <span class="label label-info">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.attachment') }}
                            </th>
                            <td>
                                @if ($task->attachment)
                                    <a href="{{ $task->attachment->getUrl() }}" target="_blank">
                                        {{ trans('global.view_file') }}
                                    </a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.due_date') }}
                            </th>
                            <td>
                                {{ $task->due_date }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.assigned_to') }}
                            </th>
                            <td>
                                {{ $task->assigned_to->name ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.task.fields.history') }}
                            </th>
                            <td>
                                <ol>
                                    @foreach ($task->assignedUsersHistory as $user)
                                        <li>
                                            {{ $user->name }} - Assigned at:
                                            {{ \Carbon\Carbon::parse($user->pivot->assigned_at)->format('d-m-Y H:i') }}
                                            @if ($user->pivot->unassigned_at)
                                                - Unassigned at: {{ $user->pivot->unassigned_at }}
                                            @endif
                                        </li>
                                    @endforeach
                                </ol>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.tasks.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
