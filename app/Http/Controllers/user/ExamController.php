<?php

namespace App\Http\Controllers\user;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Subject;
use App\TestExam;
use App\History;
use App\Question;
use PDF;
use Arr;
class ExamController extends Controller
{   

    public function __construct(){
    	$this->middleware('auth:web');
    }

    public function index(){
    	$subjects = Subject::where('status','=', 1)->get();	
    	return view('user.exam.index',['subjects' => $subjects]);
    	// dd($subjects);
    }

    public function show($id){
        $subject = Subject::find($id);
        $exams = $subject->testexam;
        return view('user.exam.show', ['exams' => $exams]);
    }

    public function review($id){
        $testexam = TestExam::find($id);
        $questions = $testexam->question;
        return view('user.exam.review', ['testexam' => $testexam ,'questions' => $questions]);

    }

    public function make(Request $request,$id){
        $testexam = TestExam::findOrFail($id);
        $questions = $testexam->question;     
        return view('user.exam.make', ['testexam'=> $testexam, 'questions' => $questions, 'request' => $request]);
    }

    public function create_history(Request $request, $id){
        $questionIdChoose = $request->input('questionChoose');
        $select = $request->input('choose');
        if(!$select):
            foreach ($questionIdChoose as $value):
                $select[$value] = " ";
            endforeach;
        else:
        $arrayKeySelect = array_keys($select);
        $missArray = array_diff($questionIdChoose, $arrayKeySelect);
        foreach ($missArray as $value) {
            $select[$value] = " ";
        }   
        endif;    
        $history = History::create([
            'testexam_id' => $id,
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        $history->choose = $select;
        $history->mark = $this->getMark($select);    
        $history->save();
        return redirect("/exam/result/detail/$history->id");
    }

    public function result_detail($id){
        $history = History::find($id);
        foreach($history->choose as $question_id => $choosed_option):
        $all_question_id[] = $question_id;  
        endforeach;
        $questions = Question::whereIn('id', $all_question_id)->get();
        $testexam = TestExam::find($history->testexam_id);
        $countQuestion = $testexam->question->count();
        return view('user.exam.result_detail', ['testexam' => $testexam, 'history' => $history, 'questions' => $questions, 'countQuestion' => $countQuestion]);
    }

    protected function getMark($choose){
        $score = 0;
        foreach($choose as $key => $val):
            $question = Question::find($key);
            if($val == $question->option->answer):
                $score++;
            endif;    
        endforeach;
        return $score;    
    }

    public function all_result(){
        $userId = Auth::guard('web')->user()->id;
        $histories = History::where('user_id', $userId)->latest()->paginate(10);
        return view('user.exam.result', ['histories' => $histories]);
    }

    public function send_mail($id){
        $userMail = Auth::guard('web')->user()->email;
        $history = History::find($id);
        foreach($history->choose as $question_id => $choosed_option):
            $all_question_id[] = $question_id;  
        endforeach;
        $questions = Question::whereIn('id', $all_question_id)->get();
        $testexam = TestExam::find($history->testexam_id);
        Mail::to($userMail)->send(new \App\Mail\ResultMail($history, $questions, $testexam));

        return redirect()->back()->with('success', 'Kết quả đã gửi đếm email của bạn.');
    }
}

