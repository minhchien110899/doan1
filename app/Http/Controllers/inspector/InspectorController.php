<?php

namespace App\Http\Controllers\inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InspectorController extends Controller
{
    public function __construct(){
        $this->middleware('auth:inspector');
    }
    
    public function index(){
        return view('inspector.index');
    }

}
