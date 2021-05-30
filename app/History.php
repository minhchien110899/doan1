<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Subject;
use App\TestExam;

class History extends Model
{
    protected $table = "history";

    protected $fillable = [
    	'user_id',
    	'testexam_id',
    ];

    protected $casts = [
    'choose' => 'array'
	]; 
    public function user(){
    	return $this->belongsTo('App\User');
    }
    public function step(){
        $history = DB::select('select step from history_personalize where history_id = ?', [$this->id])[0];
        return $history->step;
    } 
    public function belongsPersonalize(){
        $personalize = DB::select('select personalize_id from history_personalize where history_id = ?', [$this->id])[0];
        $hashing = md5($personalize->personalize_id);
        $hashing = substr($hashing, 0, 6);
        return strtoupper($hashing);
    }

}
