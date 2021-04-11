<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use App\TestExam;
use App\Personalize;
use Auth;
use DB;
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
        $questions = $testexam->question->shuffle();    
        return view('user.personalize.make', ['testexam' => $testexam, 'questions' => $questions]);
    }
}
