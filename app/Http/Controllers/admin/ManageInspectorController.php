<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inspector;
class ManageInspectorController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }
    public function index(){
        $inspectors = Inspector::all();
        return view('admin.manage_inspector', ['inspectors' => $inspectors]);
    }
    public function change_status(Request $request){

        $tatus = $request->input('status');
        $inspector = Inspector::find($request->input('id_inspector'));
        $inspector->status = $tatus;
        $inspector->save();
        return redirect()->back()->with('change_status_success', "true");
    }
}
