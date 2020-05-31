<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Task;
use App\Solution;
use Illuminate\Support\Facades\Storage;

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

        $fileName = null;
        if ($request->hasFile('file')) {
            $fileName = time().'.'.$request->file->extension();
            $request->file->move('storage', $fileName);
        }

        Solution::create([
            'task_id' => $request->input('taskId'),
            'content' => $request->input('content'),
            'user_id' => Auth::user()->id,
            'file' => $fileName
        ]);



        return redirect(route('taskProfile', $request->input('taskId')));
    }

    public function valuate($id) {
        $solution = Solution::find($id);
        return view('solution.valuate', ['data' => $solution]);
    }

    public function valuatePost(Request $request) {
        $solution = Solution::find($request->input('id'));
        $validatedData = $request->validate([
            'value' => 'required|numeric|min:0|max:'.$solution->task->value,
            'valuateText' => 'max:500'
        ]);

        $solution->value = $request->input('value');
        $solution->valuate_text = $request->input('valuateText');
        $solution->valuated_at = date("Y-m-d H:i:s");
        $solution->save();

        return redirect(route('taskProfile', $solution->task->id));
    }

    public function download($id) {
        $solution = Solution::find($id);

        if ($solution->file) {
            return Storage::disk('public')->download($solution->file);
        } else {
            return redirect(route('taskProfile', $solution->task->id));
        }
    }
}
