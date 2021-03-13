<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chapter extends Model
{
    use SoftDeletes;
    protected $fillable = [
   	'name', 'subject_id','description'
   ];


   public function subject(){
   	return $this->belongsTo('App\Subject');
   }

   public function question(){
   	return $this->hasMany('App\Question');
   }
}
