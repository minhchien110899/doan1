<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
