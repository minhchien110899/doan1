<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\History;
use App\Question;
use App\TestExam;
use App\Personalize;
use DB;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class PersonalizeDetailController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:web');
    }

    public function index($id){
        $personalize = Personalize::find($id);
        $history = $personalize->history;
        $current_step = DB::select("select max(step) as 'current_step' from history_personalize where personalize_id = ?", [$id])[0]->current_step;
        return view('user.personalize.detail.index', ['personalize' => $personalize, 'history' => $history, 'current_step' => $current_step]);
    }

    public function init(Request $request, $id){
        // questionChoose = [id cau hoi,...]; chosse = ['id cau hoi' => 'gia tri'];
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
        $history->test_entrance = 1;
        $countDown = $request->input('countDown');
        $history->time_up = 30*60 - $countDown;
        $history->save();
        // $data = ['history' => $history];
        foreach($history->choose as $question_id => $choosed_option):
            $all_question_id[] = $question_id;  
            endforeach;
        $questions = Question::whereIn('id', $all_question_id)->get();
        $check_result = [];
        $selected_choose = $history->choose;//array
        foreach($questions as $key => $question):
            $option = $question->option;
                if($option->answer == $selected_choose["$question->id"]):
                    $check_result[] = 1;
                else:
                    $check_result[] = 0;
                endif;   
        endforeach;
        $data = ['history' => $history, 'check_result' => $check_result];        
        return $data;
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

    public function createDetail(Request $request){
        $expired_time_number = $request->input('expired_time');
        $history_id = $request->input('history_id');
        $subject_id = DB::select('select t.subject_id from history h join testexams t on h.testexam_id = t.id where h.id = ?', [$history_id])[0]->subject_id;
        $personalize = Personalize::create([
            'user_id' => Auth::user()->id,
            'history_id' => $history_id,
            'subject_id' => $subject_id,
            'exam_number' => $request->input('exam_number'),
            'expect_mark' => $request->input('expect_mark'),
            'expired_time' => date("Y-m-d H:i:s", strtotime("+ $expired_time_number days")),
        ]);
        return redirect("/personalizeDetail/detail/$personalize->id")->with('success_init_personalize', 'true');
    }

    public function step(Request $request, $id){
        $personalize = Personalize::find($id);
        $history_per = DB::select("select * from history_personalize where personalize_id = $id");
        if(count($history_per) == 0){
            $testexam = TestExam::where([['subject_id', $personalize->subject_id], ['level', 1]])->get()->random();
            $questions = $this->easyStep($testexam);
            $step = 1;
            return view('user.personalize.detail.step',['testexam' => $testexam, 'questions' => $questions, 'step' => $step, 'personalize' => $personalize]);
        }else{
            
        }
    }

    protected function easyStep($testexam){
        $questions = $testexam->question;
        $chapters = DB::select('SELECT DISTINCT q.chapter_id FROM questions q JOIN question_testexam m ON q.id = m.question_id JOIN testexams t ON m.testexam_id = t.id WHERE m.testexam_id = ?', [$testexam->id]);
        //ĐV: 60 = 18de ; 30 = 9tb ; 10 = 3kho
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
        $theRestNumberQuestionNeeded = 18 - $easyQuestion_def_in_1chap->count();
        // dd($theRestNumberQuestionNeeded);
        if($theRestEasyQuestion->count() < $theRestNumberQuestionNeeded){
            return redirect()->back()->with('elearning_error_alert','Đề thi đang trong giai đoạn hoàn thiện,vui lòng chọn đề khác.');
        }
        $theRestEasyQuestion = $theRestEasyQuestion->random($theRestNumberQuestionNeeded);
        $totalEasyQuestions = $theRestEasyQuestion->merge($easyQuestion_def_in_1chap);
        // dd($totalEasyQuestions);
        $totalMediumQuestions = $questions->where('level', '2')->random(9);
        // dd($totalMediumQuestions);
        $totalHardQuestions = $questions->where('level', '3')->random(3);
        // dd($totalHardQuestions);
        $questions = $totalEasyQuestions->merge($totalHardQuestions)->merge($totalMediumQuestions);
        $questions = $questions->shuffle();
        return $questions;
    }
    private function normalStep($testexam){
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
        return $questions;
    }
    private function hardStep($testexam){
        $questions = $testexam->question;
        $chapters = DB::select('SELECT DISTINCT q.chapter_id FROM questions q JOIN question_testexam m ON q.id = m.question_id JOIN testexams t ON m.testexam_id = t.id WHERE m.testexam_id = ?', [$testexam->id]);
        //ĐV: 30 = 9de ; 40 = 12tb ; 30 = 9kho
        $easyQuestion_def_in_1chap = collect();
        foreach($chapters as $chapt):
            $easyQuestion_def_in_chap = $questions->where('level', '3')->where('chapter_id', $chapt->chapter_id);
            if($easyQuestion_def_in_chap->isNotEmpty()):
                $easyQuestion_def_in_1chap->push($easyQuestion_def_in_chap->random()); 
            endif;    
        endforeach;
        // dd($easyQuestion_def_in_1chap);
        $theRestEasyQuestion = $questions->where('level', '1')->diff($easyQuestion_def_in_1chap);
        // dd($theRestEasyQuestion->where('level', '1'));
        // dd($easyQuestion_def_in_1chap->count());
        $theRestNumberQuestionNeeded = 9 - $easyQuestion_def_in_1chap->count();
        // dd($theRestNumberQuestionNeeded);
        if($theRestEasyQuestion->count() < $theRestNumberQuestionNeeded){
            return redirect()->back()->with('elearning_error_alert','Đề thi đang trong giai đoạn hoàn thiện,vui lòng chọn đề khác.');
        }
        $theRestEasyQuestion = $theRestEasyQuestion->random($theRestNumberQuestionNeeded);
        $totalEasyQuestions = $theRestEasyQuestion->merge($easyQuestion_def_in_1chap);
        // dd($totalEasyQuestions);
        $totalMediumQuestions = $questions->where('level', '2')->random(12);
        // dd($totalMediumQuestions);
        $totalHardQuestions = $questions->where('level', '3')->random(9);
        // dd($totalHardQuestions);
        $questions = $totalEasyQuestions->merge($totalHardQuestions)->merge($totalMediumQuestions);
        $questions = $questions->shuffle();
        return $questions;
    }

    public function create_history(Request $request, $id, $step){
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
            'testexam_id' => $request->input('personalize_id'),
            'user_id' => Auth::guard('web')->user()->id,
        ]);
        $history->choose = $select;
        $history->mark = $this->getMark($select);    
        $history->test_entrance = 2;
        $countDown = $request->input('countDown');
        $history->time_up = 30*60 - $countDown;
        $history->save();
        DB::insert('insert into history_personalize (history_id, personalize_id, step) values (?, ?, ?)', [$history->id, $id, $step]);
        return redirect("/personalizeDetail/detail/$id/history/$step");
    }
    public function history($id, $step){
        $personalize = Personalize::find($id);
        // $history = History::find($personalize->history_id);
        $history = DB::select('select h.*,hp.* from history h join history_personalize hp on h.id=hp.history_id join personalizes p on p.id=hp.personalize_id where hp.step = ? and p.id = ?', [$step, $id])[0];
        // dd($history);
        $choose = json_decode($history->choose, true);
        foreach(json_decode($history->choose) as $question_id => $choosed_option):
        $all_question_id[] = $question_id;
        endforeach;
        $questions = Question::whereIn('id', $all_question_id)->get();
        $testexam = TestExam::find($history->testexam_id);
        $countQuestion = $testexam->question->count();
        return view('user.personalize.detail.result_detail', ['testexam' => $testexam, 'history' => $history, 'questions' => $questions, 'countQuestion' => $countQuestion, 'choose' =>$choose]);
    }
}
