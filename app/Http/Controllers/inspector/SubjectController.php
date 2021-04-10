<?php

namespace App\Http\Controllers\inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use App\Chapter;

class SubjectController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:inspector');
    }

    public function index(){
        $subjects = Subject::withCount('testexam')->get();
        $trash_subjects = Subject::onlyTrashed()->get(); 
        return view('inspector.subject',['subjects' => $subjects, 'trash_subjects' => $trash_subjects]);
    }

    public function change_name(Request $request, $id){
    	$request->validate(['name' => 'max:20']);
    	$subject = Subject::find($id);
    	$subject->name = $request->input('name');
    	$subject->save();
        $chapters = Chapter::whereIn('id', $request->chapter_id)->get();
        foreach ($chapters as $chapter) {
            $id = $chapter->id;
            $chapter->description = $request->chapter_description[$id];
            $chapter->save();
        }
    	return redirect()->back();
    }

    public function off_status(Request $request, $id){
    	$subject = Subject::find($id);
    	$subject->status = 0;
    	$subject->save();
    	return redirect()->back();
    }

    public function on_status(Request $request, $id){
    	$subject = Subject::find($id);
    	$subject->status = 1;
    	$subject->save();
    	return redirect()->back();
    }

    public function add_subject(Request $request){
    	$subject =Subject::firstOrCreate(['name' => $request->input('name')]);
    	// dd($request->all());
    	return redirect()->back();
    }

    public function del_subject(Request $request, $id){
    	$subject = Subject::find($id)->delete();
    	return redirect()->back();
    }

    public function restore_trash($id){
    	$subject = Subject::onlyTrashed()->where('id', $id)->restore();
    	return redirect()->back();
    }
}
