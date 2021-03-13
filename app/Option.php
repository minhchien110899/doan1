<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{
   use SoftDeletes;

   protected $fillable = [
   	'name', 'question_id','answer',
   ];

   protected $casts = [
    'name' => 'array'
	]; 

   public function question(){
   	return $this->belongsTo('App\Question');
   }
}
