<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Option;

class OptionController extends Controller
{
     public function __construct(){
    	$this->middleware('auth:admin');
    }

    public function change_answer(Request $request, $id){
    	$option_changed = Option::find($id);
    	$option_changed->answer = $request->input('answer');
    	$option_changed->save();
    	return redirect()->back(); 
    }
}
