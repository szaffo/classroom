<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Task;

class TasksController extends Controller{

    public function __construct(){
        $this->middleware('auth');
    }

    public function new($subjectId) {
        if (!Auth::user()->teacher) return redirect(RouteServiceProvider::HOME);

        $data = (object) array('name' => '', 'value' => '', 'description' => '', 'origin' => 'subject', 'id' => 0, 'subjectId' => $subjectId, 'start' => date('Y-m-d'), 'deadline' => date('Y-m-d'));
        return view('task.newTask', ['data' => $data]);
    }


    public function validateForm(Request $request) {

        // New task
        if ($request->input('origin') == 'subject') {
            $validatedData = $request->validate([
                'name' => 'required|max:100|min:5',
                'description' => 'max:500|required',
                'value' => 'required|numeric|min:0',
                'start' => 'required|date',
                'deadline' => 'required|date|after:start',
            ]);
            Task::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'value' => $request->input('value'),
                'start' => $request->input('start'),
                'deadline' => $request->input('deadline'),
                'subject_id' => $request->input('subjectId'),
            ]);

        // Edit existing task
        } else if ($request->input('origin') == 'profile') {
            $validatedData = $request->validate([
                'name' => 'required|max:100|min:5',
                'description' => 'max:500',
                'value' => 'required|numeric|min:0',
                'start' => 'date|min:now',
                'deadline' => 'date|min:now'
            ]);
            $task = Task::find($request->input('id'));
            $task->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'value' => $request->input('value'),
                'start' => $request->input('start'),
                'deadline' => $request->input('deadline'),
                'subject_id' => $request->input('subjectId'),
            ]);
            return redirect(route('taskProfile', $request->input('id')));
        }


        return redirect(route('subjectProfile', $request->input('subjectId')));
    }

    public function profile($id) {
        return view('task.taskProfile', ['data' => Task::find($id)]);
    }

    public function edit($id) {
        $data = Task::find($id);
        $data['origin'] = 'profile';
        $data['id'] = $id;
        $data['subjectId'] = $data->subject->id;
        return view('task.newTask', ['data' => $data]);
    }

    public function list() {
        if (Auth::user()->teacher) return redirect(RouteServiceProvider::HOME);
        return view('task.taskList');
    }

    public function delete($id) {
        $task = Task::find($id);
        $subjectId = $task->subject->id;
        $task->delete();
        return redirect(route('subjectProfile', $subjectId));
    }

}
