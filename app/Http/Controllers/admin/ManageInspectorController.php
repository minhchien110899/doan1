<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Inspector;
use App\Subject;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

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
        return redirect()->back()->with('changed_success_alert', "true");
    }
    public function reset_password(Request $request){
        $inspector = Inspector::find($request->input('id_inspector'));
        $inspector->password = Hash::make("password");
        $inspector->save();
        Mail::to($inspector->email)->send(new \App\Mail\SendPasswordMail("Giáo viên", "password"));
        return redirect()->back()->with('changed_success_alert', "true");
    }
    public function adding_page(){
        $subjects = Subject::all();
        return view('admin.add_inspector', ['subjects' => $subjects]);
    }
    public function add_inspector(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z_ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểếỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ ]{4,50}$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' =>['required','max:20','unique:users', 'regex:/^(?=[a-zA-Z0-9._]{8,20}$)(?!.*[_.]{2})[^_.].*[^_.]$/'],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->except('password'));
        }
        $name = $request->input('name');
        $email = $request->input('email');
        $username = $request->input('username');
        $password = $request->input('password') ?? 'password';
        $subject_id = $request->input('subject_id');
        Inspector::create([
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => Hash::make($password),
            'subject_id' => $subject_id
        ]);
        return redirect(route('admin.inspector'))->with('added_inspector_success_alert', 'true');

    }
}
