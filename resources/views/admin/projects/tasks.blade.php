@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Project Tasks</h1>

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="mb-3">
            <a href="{{ route('admin.tasks.create', ['project' => $project]) }}" class="btn btn-primary">Add Task</a>
        </div>
        @if ($tasks->isEmpty())
            <div class="alert alert-info">
                There are no tasks for this project.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th>Status</th>
                            <th> Due Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $task->task->name }}</td>
                                <td>
                                    <span class="badge badge-{{ $task->status === 'completed' ? 'success' : 'warning' }}">
                                        {{ ucfirst($task->task->status->name) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-{{ $task->is_overdue ? 'danger' : 'info' }}">
                                        {{ $task->task->due_date }}
                                    </span>
                                <td>
                                    <a href="{{ route('admin.tasks.edit', $task) }}" class="btn btn-sm btn-primary">Edit</a>
                                    {{-- Mark as finish --}}
                                    @if($task->task->status->id !== 3)
                                    <form action="{{ route('admin.tasks.markAsDone', $task) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="completed">
                                        <button type="submit" class="btn btn-sm btn-success">Mark as Finish</button>
                                    </form>
                                    @endif
                                    {{-- Delete --}}
                                    <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Delete</button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
