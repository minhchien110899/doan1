<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class AdminLoginController extends Controller
{
	public function __construct(){
		$this->middleware('guest:admin')->except('logout');
	}

    public function login(){
    	return view('admin.login1');
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
      if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        return redirect()->intended(route('admin.index'));
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->except('password'))->with('error', 'Đăng nhập thất bại');	
    
    }

    public function logout(){
    	Auth::guard('admin')->logout();
        return redirect('/');
    }
}
