<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Subject;
class AdminController extends Controller
{
    public function __construct(){
		$this->middleware('auth:admin');
	}

	public function index(Request $request){
		$count_user = DB::table('users')->count();
		$count_subject = Subject::count();
		$count_testexam = DB::table('testexams')->count();
		return view('admin.index',['count_user' => $count_user, 'count_testexam' => $count_testexam, 'count_subject' => $count_subject]);

	}

	public function profile(){
		return view('admin.profile');
	}


	// public function 
}
