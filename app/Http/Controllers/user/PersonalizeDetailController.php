<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\History;
use App\Question;
use Illuminate\Support\Facades\Auth;
use PHPUnit\Framework\Constraint\Count;

class PersonalizeDetailController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:web');
    }

    public function index(Request $request, $id){
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

    public function createDetail(Request $request, $id){
        
    }
}
