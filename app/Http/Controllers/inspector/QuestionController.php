<?php

namespace App\Http\Controllers\inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;
use App\Chapter;
use App\Question;
use App\TestExam;
use App\Option;

class QuestionController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:inspector');
    }
    public function index(Request $request){
        if(!empty($request->subject_id) &&  $request->subject_id != 'all'):
            $subjects = Subject::where('id', $request->subject_id)->get();
        else:
            $subjects = Subject::all();    
        endif;    
        $chapters = Chapter::all();
        $trash_questions = Question::onlyTrashed()->get();
        return view('inspector.question', ['subjects' => $subjects,'subjects_template' => Subject::all() , 'chapters' => $chapters, 'trash_questions' => $trash_questions, 'req_subject' => $request->subject_id]);
    }
    public function change_content(Request $request ,$id){
        $question = Question::find($id);
        $question->content = $request->input('content');
        $question->option->name = $request->name_change;
        if($request->input('answer_change') == 'option1'):
            $question->option->answer = $request->name_change[0];
        elseif($request->input('answer_change') == 'option2'):
            $question->option->answer = $request->name_change[1];
        elseif($request->input('answer_change') == 'option3'):
            $question->option->answer = $request->name_change[2];
        else:
            $question->option->answer = $request->name_change[3];     
        endif;
        // $question->save();
        // return redirect()->back();
        $question->save();
        $question->option->save();
        return redirect()->back();
    }

    public function del_question($id){
        $question = Question::find($id)->delete();
        return redirect()->back();
    }

    public function add_question(Request $request){
        $request->validate(
            [
                'chapter_id' =>'required',
                'level' => 'required',
                'content' => 'required',
                'answer' => 'required'
            ]);
        if($request->input('chapter_id') == "null"){
            return redirect()->back()->with('error', 'Chưa chọn chương. Vui lòng thử lại!');
        }    
        $question = Question::firstOrCreate([
            'content' => $request->input('content'),
            'chapter_id' => $request->chapter_id,
            'level' => $request->level
        ]);
        $question_id = Question::where([['content',$request->input('content')],['chapter_id',$request->chapter_id]])->first()->id;
        $option = new Option;
        $option->question_id = $question_id;
        $option->name = $request->input('name');
        if($request->input('answer') == 'option1'):
            $option->answer = $request->name[0];
        elseif($request->input('answer') == 'option2'):
            $option->answer = $request->name[1];
        elseif($request->input('answer') == 'option3'):
            $option->answer = $request->name[2];
        else:
            $option->answer = $request->name[3];     
        endif;
        $option->save();
        return redirect()->back();
    }

    public function restore_trash($id){
        $question = Question::onlyTrashed()->where('id', $id)->restore();
        return redirect()->back();
    }
}
