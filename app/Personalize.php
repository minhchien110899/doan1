<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Personalize extends Model
{
    protected $fillable = [
        'user_id', 'subject_id', 'performance', 'done', 'checkFirstTest'
    ];

    public function subject(){
    	return $this->hasMany('App\Subject');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
