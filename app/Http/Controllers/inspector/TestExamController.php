<?php

namespace App\Http\Controllers\inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TestExam;
use App\Subject;
use App\Question;
use DB;
use Illuminate\Support\Facades\Auth;

class TestExamController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:inspector');
    }

    public function index(){
        $subject_id = Auth::user()->subject_id;
    	$testexams = TestExam::withCount('question')->where('subject_id', $subject_id)->orderBy('subject_id','asc')->paginate(15);
    	$trash_testexams = TestExam::onlyTrashed()->where('subject_id', $subject_id)->get();
        $subject = Subject::find($subject_id); 
    	return view('inspector.testexam', ['testexams' => $testexams, 'trash_testexams' => $trash_testexams, 'subject' => $subject]);
    }

    public function change_name(Request $request, $id){
    	$testexam = TestExam::find($id);
    	$testexam->name = $request->input('name');
    	$testexam->save();
    	return redirect()->back();
    }

    public function del_testexam(Request $request, $id){
    	$testexam = TestExam::find($id)->delete();
    	return redirect()->back();
    }

    public function restore_trash($id){
    	$subject = TestExam::onlyTrashed()->where('id', $id)->restore();
    	return redirect()->back();
    }

    public function add_testexam(Request $request){
        $request->validate([
            'subject_id' => 'integer|required',
            'name' => 'required',
        ],[
            'name.required' => 'Vui lòng thêm tên đề',
            'subject_id.required' => 'Vui lòng chọn môn học mà đề thuộc.',    
        ]);
        if($request->input('level') == 'null'):
            TestExam::firstOrCreate([
                'name' => $request->input('name'),
                'subject_id' => $request->input('subject_id'),
                'description' => $request->input('description'),  
            ]);
        else:
            TestExam::firstOrCreate([
                'name' => $request->input('name'),
                'subject_id' => $request->input('subject_id'),
                'description' => $request->input('description'),
                'level' => $request->input('level'),    
            ]);    
        endif;    
        
        return redirect()->back();
    }

    public function review($id){
        $testexam = TestExam::find($id);
        $subject_belongs = $testexam->subject->id;
        $questions_subject = DB::select("select a.* from questions a join chapters b on a.chapter_id = b.id join subjects c on c.id = b.subject_id where c.id = $subject_belongs");            
        $questions_belongs = [];
        $allquestion = [];
        $questions = $testexam->question;
        foreach ($questions_subject as $key1 => $val1) {
               $allquestion[] = $val1->id;
        }
        foreach ($questions as $key2 => $val2) {
               $questions_belongs[] = $val2->id;
           } 
        // Câu hỏi không có trong đề nhưng có trong khung môn học   
        $questions_notBelongs = array_diff($allquestion, $questions_belongs);
        $questions_notBelongs = Question::whereIn('id', $questions_notBelongs)->orderBy('chapter_id','asc')->orderBy('level', 'asc')->get();  
        return view('inspector.testexam.review', ['testexam' => $testexam, 'questions' => $questions, 'questions_notBelongs' => $questions_notBelongs]);
    }

    public function add_question(Request $request,$id){
        $questions_added = $request->question_added;
        $testexam = TestExam::find($id);
        $testexam->question()->attach($questions_added);
        return redirect()->back();
    }

    public function del_question(Request $request, $testexam_id, $question_id){
        $testexam = TestExam::find($testexam_id);
        $testexam->question()->detach($question_id);
        return redirect()->back();
    }
}
