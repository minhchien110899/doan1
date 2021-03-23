<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\Auth;
class SettingController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:web');
    }
    public function index(){
        return view('user.setting.index');
    }
    public function change_theme_color(Request $req){
        $theme_color = $req->input('theme_color');
        $user_id = Auth::guard('web')->user()->id;
        $checkExist = Setting::where('user_id', $user_id)->first();
        if(!empty($checkExist->theme_color)):
            $checkExist->theme_color = $theme_color;
            $checkExist->save();
        else:
            $new_setting = Setting::create([
                'theme_color' => $theme_color,
                'user_id' => $user_id,
            ]);
            $new_setting->save();
        endif;    
        return redirect()->back()->with('success', 'Cập nhập màu nền thành công.');
    }
}
