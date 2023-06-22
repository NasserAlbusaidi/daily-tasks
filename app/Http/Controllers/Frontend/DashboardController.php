<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController
{
    public function index( Request $request)
    {
        $id = $request->user()->id;
        $user = User::find($id);
        $totalTasks = Task::where('assigned_to_id', $id)->count();
        $tasksDueToday = Task::whereDate('due_date', date('Y-m-d'))->where('assigned_to_id', $id)->count();
        $overdueTasks = Task::whereDate('due_date', '<', date('Y-m-d'))->where('assigned_to_id', $id)->count();
        $tasksDueTodayDetails = Task::whereDate('due_date', date('Y-m-d'))->where('assigned_to_id', $id)->get();
        $completedTasks = Task::where('status_id', 3)->where('assigned_to_id', $id)->count();
        $openTasks = Task::where('status_id', 1)->where('assigned_to_id', $id)->count();
        $progress = $totalTasks > 0 ? ($completedTasks / $totalTasks) * 100 : 0;
        $upcomingTasks = Task::whereDate('due_date', '>', date('Y-m-d'))->where('assigned_to_id', $id)->first();

        // dd($userTask);


       return view('frontend.dashboard', compact('totalTasks', 'tasksDueToday', 'overdueTasks', 'progress', 'completedTasks', 'openTasks', 'tasksDueTodayDetails', 'upcomingTasks'));
    }
}
