<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
