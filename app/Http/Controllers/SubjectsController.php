<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Subject;

class SubjectsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function newSubject() {
        if (Auth::user()->teacher) {
            $data = (object) array('name' => '', 'code'=>'', 'description'=>'', 'kredit' => '', 'origin' => 'home', 'id' => 0);
            return view('newSubject', ['data' => $data]);
        }
        return redirect(RouteServiceProvider::HOME);
    }

    public function validateForm(Request $request) {

        // New subject
        if ($request->input('origin') == 'home') {
            $validatedData = $request->validate([
                'name' => 'required|max:100|min:3',
                'description' => 'max:500',
                'code' => 'required|regex:^IK-([A-Z]){3}\d\d\d^|unique:App\Subject',
                'kredit' => 'required|numeric|min:0'
            ]);
            Subject::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'code' => $request->input('code'),
                'kredit' => $request->input('kredit'),
                'user_id' => Auth::user()->id,
            ]);
        
        // Edit existing subject
        } else if ($request->input('origin') == 'profile') {
            $validatedData = $request->validate([
                'name' => 'required|max:100|min:3',
                'description' => 'max:500',
                'code' => 'required|regex:^IK-([A-Z]){3}\d\d\d^',
                'kredit' => 'required|numeric|min:0'
            ]);
            $subject = Subject::find($request->input('id'));
            $subject->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'code' => $request->input('code'),
                'kredit' => $request->input('kredit'),
            ]);
            return redirect(route('subjectProfile', $request->input('id')));
        }


        return redirect(RouteServiceProvider::HOME);
    }

    public function togglePrivacy($subjectId) {
        $subject = Subject::find($subjectId);
        $subject->public = !$subject->public;
        $subject->save();

        return redirect(RouteServiceProvider::HOME);
    }

    public function profile($id) {
        return view('subjectProfile', ['data' => Subject::find($id)]);
    }

    public function edit($id) {
        $data = Subject::find($id);
        $data['origin'] = 'profile';
        $data['id'] = $id;
        return view('newSubject', ['data' => $data]);
    }

    public function delete($id) {
        Subject::find($id)->delete();
        return redirect(RouteServiceProvider::HOME);
    } 

    public function list() {
        $data = Subject::all()->where('public', true)->diff(Auth::user()->subjects);
        return view('home', ['data' => $data]);
    }

    public function subscribe($subjectId) {
        Auth::user()->subjects()->attach(Subject::find($subjectId));
        return redirect(RouteServiceProvider::HOME);
    }

    public function unSubscribe($subjectId) {
        Auth::user()->subjects()->detach(Subject::find($subjectId));
        return redirect(RouteServiceProvider::HOME);
    }
}
