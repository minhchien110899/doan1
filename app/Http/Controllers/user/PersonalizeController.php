<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalizeController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:web');
    }
    public function index(){
        return view('user.personalize.index');
    }
}
