<?php

namespace App\Http\Controllers\inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InspectorLoginController extends Controller
{
    public function __construct(){
		$this->middleware('guest:inspector')->except('logout');
	}
    public function login(){
        return view('inspector.login');
    }
    public function postlogin(Request $request){

    	$request->validate([
    		'username' => 'required',
    		'password' => 'required'
    	]);
    // 	if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)){
    // 		echo 'co du lieu';
    // 	} else {
    // 		echo 'khong co du lieu';
    // 	}
    // // Attempt to log the user in
      if (Auth::guard('inspector')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('inspector.index'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->except('password'))->with('error', 'Đăng nhập thất bại');	
    
    }

    public function logout(){
    	Auth::guard('inspector')->logout();
        return redirect('/');
    }
}
