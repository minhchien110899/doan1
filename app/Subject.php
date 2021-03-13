<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
	use SoftDeletes;

	protected $fillable = [
        'name',
    ];

    public function testexam(){
    	return $this->hasMany('App\TestExam');
    }
    public function chapter()
    {
    	return $this->hasMany('App\Chapter');
    }

    
}
