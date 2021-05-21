<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Personalize extends Model
{
    protected $fillable = [
        'user_id','history_id','subject_id','exam_number', 'expect_mark','expired_time',
    ];

    // public function subject(){
    // 	return $this->hasMany('App\Subject');
    // }
    public function history(){
        return $this->belongsToMany('App\History', 'history_personalize', 'personalize_id', 'history_id');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function current_step(){
        $current_step =DB::select("select max(step) as 'current_step' from history_personalize where personalize_id = ?", [$this->id])[0]->current_step;
        return $current_step;
    }
    public function check_success(){
        $exam_number = DB::select('select * from personalizes where id = ?', [$this->id])[0]->exam_number;
        $expect_mark = DB::select('select * from personalizes where id = ?', [$this->id])[0]->expect_mark;
        $final_exam_history = DB::select('select * from history h join history_personalize hp on h.id = hp.history_id where hp.personalize_id = ? and step = ?', [$this->id, $exam_number])[0];
        $true = $final_exam_history->mark;
        $mark = ($true * 10) / 30;
        if($mark >= $expect_mark){
            return 1;
        }
        else{
            return 0;
        }
    }
}
