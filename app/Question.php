<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'content','chapter_id', 'level'
    ];

    public function testexam(){
    	return $this->belongsToMany('App\TestExam', 'question_testexam', 'question_id', 'testexam_id');
    }

    public function chapter(){
        return $this->belongsTo('App\Chapter');
    }

    public function option(){
    	return $this->hasOne('App\Option');
    }
    public function getLevel(){
        $testexam = self::find($this->id);
        $level = $testexam->level;
        if($level == 1):
             return "Dễ";
        elseif($level == 2):
             return "Bình thường";
        elseif($level == 3):
             return "Khó";
        else:
           return " ";          
        endif;  
     }
}
