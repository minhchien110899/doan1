<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Subject;
use App\Option;
class TestController extends Controller
{
    public function index(){
    	// $subjects = TestExam::inRandomOrder()->where('subject_id','=','1')->pluck('name');
    	// // $subjects = Db::table('subjects')->get();
    	// dd($subjects);

    	$demo = Subject::all();
    	 // dd($demo);
    	foreach ($demo as $value) {
    		dd($value->testexam()->pluck('name'));
    	}
    }

    public function checkJson(){
        $options = Option::select('name')->get();
        // [{'name':['a', 'b']},{},{}]
        foreach ($options as $key => $option) {
            foreach ($option->name as $key => $value) {
                echo $value.'<br>';
            }
        }
    }

    public function checkcountdown(){
        return view('test',['phut' => 1]);
    }

    public function __construct(){
        $this->middleware('auth:admin');
    }
    public function testlive(){
        return view('testlive');
    }
    public function linkstorage(){
        Artisan::call('storage:link');
    }
}
