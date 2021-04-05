<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class ManageUserController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }
    public function index(){
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.manage_user', ['users' => $users]);
    }
    public function reset_password(Request $req){
        $user = User::find($req->input('id_user'));
        $user->password = Hash::make('password'. $req->input('id_user'));
        $user->save();
        return redirect()->back()->with('changed_success_alert', 'true');
    }
}
