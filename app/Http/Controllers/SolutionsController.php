<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Task;
use App\Solution;

class SolutionsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function new($taskId) {
        $task = Task::find($taskId);
        return view('solution.newSolution', ['taskId' => $taskId, 'task' => $task]);
    }

    public function validateForm(Request $request) {

        $validatedData = $request->validate([
            'taskId' => 'required|numeric',
            'content' => 'required|max:1500'
        ]);
        Solution::create([
            'task_id' => $request->input('taskId'),
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id
        ]);

        return redirect(route('taskProfile', $request->input('taskId')));
    }
}
