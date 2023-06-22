@extends('layouts.frontend')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center bg-primary text-white">
                    <h2><i class="fas fa-user"></i> Welcome, {{ auth()->user()->name }}!</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card text-white bg-info mb-3 text-center">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-tasks"></i> Total Tasks</h5>
                                    <p class="card-text">{{ $totalTasks }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card text-white bg-warning mb-3 text-center">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-running"></i> Open Tasks</h5>
                                    <p class="card-text">{{ $openTasks }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card text-white bg-success mb-3 text-center">
                                <div class="card-body">
                                    <h5 class="card-title"><i class="fas fa-check"></i> Closed Tasks</h5>
                                    <p class="card-text">{{ $completedTasks }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card text-dark mt-4 mb-3">
                                <div class="card-header bg-info text-white text-center">
                                    <h4 class="card-title mt-2"><i class="fas fa-clock"></i> Next Task</h4>
                                </div>
                                <div class="card-body">
                                    @if($upcomingTasks)



                                        <h5 class="card-subtitle mb-2 text-muted">Title:</h5>
                                        <p class="card-text text-dark">{{ $upcomingTasks->name }}</p>
                                        <hr>
                                        <h5 class="card-subtitle mb-2 text-muted">Due date:</h5>
                                        <p class="card-text text-dark">{{ $upcomingTasks->due_date }}</p>
                                        <hr>
                                        @php
                                            $now = \Carbon\Carbon::now();
                                            $due_date = \Carbon\Carbon::parse($upcomingTasks->due_date);
                                            $diff = $now->diffInHours($due_date, false);
                                        @endphp
                                        <h5 class="card-subtitle mb-2 text-muted">Remaining Time:</h5>
                                        <p class="card-text text-dark">

                                                {{ $diff }} hour(s)



                                        </p>

                                    @else
                                        <p class="card-text text-muted">There is no next task</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card text-dark mt-4 mb-3">
                        <div class="card-header bg-info text-white text-center">
                            <h4 class="card-title mt-2"><i class="fas fa-calendar-day"></i> Tasks Due Today</h4>
                        </div>
                        <div class="card-body">
                            @if($tasksDueToday > 0)
                                @foreach($tasksDueTodayDetails as $task)
                                    <h5 class="card-subtitle mb-2 text-muted">{{ $task->name }}</h5>
                                    <hr>
                                @endforeach
                            @else
                                <p class="card-text text-dark">No tasks due today.</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-center mb-4">
                        <a href="/tasks" class="btn btn-primary btn-lg">View All Tasks</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
