<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use function Aws\filter;

class TestExam extends Model
{
    protected $table = 'testexams';
    use SoftDeletes;

    protected $fillable = [
        'name', 'description','subject_id', 'level'
    ];

    public function subject(){
    	return $this->belongsTo('App\Subject');
    }

    public function question(){
    	return $this->belongsToMany('App\Question', 'question_testexam', 'testexam_id', 'question_id');
    }

    public function getLevel($id){
       $testexam = self::find($id);
       $level = $testexam->level;
       if($level == 1):
            return "Dễ";
       elseif($level == 2):
            return "Bình thường";
       elseif($level == 3):
            return "Khó";
       elseif($level == 4):
            return "Chung";
       else:
          return "Đề mẫu";          
       endif;  
    }
}
