<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Socialite;
use Auth;
use Exception;
use App\User;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
      
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->user();
     
            $finduser = User::where('google_id', $user->id)->first();
     
            if($finduser){
     
                Auth::login($finduser);
    
                return redirect('/')->with('login_success', "true");
     
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'username' => $user->email,
                    'email' => $user->email,
                    'google_id'=> $user->id,
                    'password' => Hash::make("password") 
                ]);
    
                Auth::login($newUser);
     
                return redirect('/')->with('login_success', "true");
            }
    
        } catch (Exception $e) {
            session_start();
            session_destroy();
            return redirect('/login')->with('error', 'Mail này đã được đăng kí. Xin vui lòng thử lại');
        }
    }
}
