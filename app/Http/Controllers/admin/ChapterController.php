<?php

namespace App\Http\Controllers\admin;

use Illuminate\Database\Eloquent\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Chapter;
use App\Subject;
class ChapterController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }

    public function add_chapter(Request $request){
    	$request->validate(['description' => 'required']);
    	$subject_id = $request->subject_id;
    	$count_chapters = Chapter::where('subject_id', $subject_id)->count();
    	$chapter = Chapter::firstOrCreate([
    		'description' => $request->description,
    		'name' => 'Chương '. ++$count_chapters,
    		'subject_id' => $subject_id,
    	]);
    	return redirect()->back();
    }

    public function del_chapter($id){
    	$chapter = Chapter::find($id);
    	$subject_id = $chapter->subject->id;
    	$chapter->delete();
    	$chapters = Chapter::where('subject_id', $subject_id)->orderBy('name', 'asc')->get();
    	foreach ($chapters as $key => $chapter) {
    		$chapter->name = 'Chương '. ++$key;
    		$chapter->save(); 
    	}
    	return redirect()->back();
    }
}
