<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use App\TestExam;
use App\Personalize;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;

class PersonalizeController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:web');
    }
    public function index(){
        $user_id = Auth::guard('web')->user()->id;
        $personalizes = Personalize::where('user_id', $user_id)->get();	
        return view('user.personalize.index', ['personalizes' => $personalizes]);
    }
    public function init_personalize(){
        $subjects = DB::select('select * from subjects where id = any(select subject_id from testexams where level = ?)', [4]);
        return view('user.personalize.init_personalize', ['subjects' => $subjects]);        
    }
    public function make(Request $req, $subject_id){
        $subject = Subject::where('id', $subject_id)->get()->first();
        $testexam = TestExam::where([['subject_id', $subject_id], ['level', 4]])->get()->random();
        $questions = $testexam->question;
        $chapters = DB::select('SELECT DISTINCT q.chapter_id FROM questions q JOIN question_testexam m ON q.id = m.question_id JOIN testexams t ON m.testexam_id = t.id WHERE m.testexam_id = ?', [$testexam->id]);
        //ĐV: 40 = 12de ; 45 = 14tb ; 15 = 4kho
        $easyQuestion_def_in_1chap = collect();
        foreach($chapters as $chapt):
            $easyQuestion_def_in_chap = $questions->where('level', '1')->where('chapter_id', $chapt->chapter_id);
            if($easyQuestion_def_in_chap->isNotEmpty()):
                $easyQuestion_def_in_1chap->push($easyQuestion_def_in_chap->random()); 
            endif;    
        endforeach;
        // dd($easyQuestion_def_in_1chap);
        $theRestEasyQuestion = $questions->where('level', '1')->diff($easyQuestion_def_in_1chap);
        // dd($theRestEasyQuestion->where('level', '1'));
        // dd($easyQuestion_def_in_1chap->count());
        $theRestNumberQuestionNeeded = 12 - $easyQuestion_def_in_1chap->count();
        // dd($theRestNumberQuestionNeeded);
        if($theRestEasyQuestion->count() < $theRestNumberQuestionNeeded){
            return redirect()->back()->with('elearning_error_alert','Đề thi đang trong giai đoạn hoàn thiện,vui lòng chọn đề khác.');
        }
        $theRestEasyQuestion = $theRestEasyQuestion->random($theRestNumberQuestionNeeded);
        $totalEasyQuestions = $theRestEasyQuestion->merge($easyQuestion_def_in_1chap);
        // dd($totalEasyQuestions);
        $totalMediumQuestions = $questions->where('level', '2')->random(14);
        // dd($totalMediumQuestions);
        $totalHardQuestions = $questions->where('level', '3')->random(4);
        // dd($totalHardQuestions);
        $questions = $totalEasyQuestions->merge($totalHardQuestions)->merge($totalMediumQuestions);
        $questions = $questions->shuffle();
        return view('user.personalize.make', ['testexam' => $testexam, 'questions' => $questions]);
    }
    public function test(){
        $personalize = Personalize::find(4);
        $subject = Subject::find($personalize->subject_id);
        $time = $personalize->expired_time; 
        Mail::to('trinhminhchien110899@gmail.com')->send(new \App\Mail\SendPersonalize($subject->name, $time));
        echo "đã gửi";
    }
}
