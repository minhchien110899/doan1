<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Subject;

class PersonalizeController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:web');
    }
    public function index(){
        $subjects = Subject::where('status','=', 1)->get();	
        return view('user.personalize.index', ['subjects' => $subjects]);
    }
}
