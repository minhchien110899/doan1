<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TestExam extends Model
{
    protected $table = 'testexams';
    use SoftDeletes;

    protected $fillable = [
        'name', 'description','subject_id',
    ];

    public function subject(){
    	return $this->belongsTo('App\Subject');
    }

    public function question(){
    	return $this->belongsToMany('App\Question', 'question_testexam', 'testexam_id', 'question_id');
    }
}
