<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
use Illuminate\Support\Facades\Storage;

class ProfileUserController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:web');
    }

    public function index(){
    	$id = Auth::guard('web')->user()->id;
    	$user = User::findOrFail($id);
    	return view('user.profile.index',['user' => $user]);
    }

    public function change_avatar(Request $request){
    	$request->validate([
            'avatar' =>'image|required',
        ],[
            'avatar.image' => 'File phải là file ảnh.',
        ]);

        // if($request->hasFile('avatar')){
        //     $name_stored = $request->file('avatar')->hashName();
        //     //upload file
        //     $path = $request->file('avatar')->storeAs('public/avatar-user', $name_stored);
        // }
        if($request->hasFile('avatar')):
            $new_avatar = $request->file('avatar')->store('avatar-user', 's3');
            Storage::disk('s3')->setVisibility($new_avatar, 'public');
        endif;    
        $id_user = Auth::guard('web')->user()->id;
        $user = User::findOrFail($id_user);
        $old_avatar = $user->avatar ?? Null;
        if($old_avatar){
            Storage::disk('s3')->delete($old_avatar);
        }
        $user->avatar = Storage::disk('s3')->url($new_avatar);
        $user->save();

        return redirect()->back()->with('success', 'Cập nhập ảnh đại diện thành công.');
    }


    public function change_info(Request $request){

        $name = $request->input('name');
        $phone = $request->input('phone') ?? Null;
        $address = $request->input('address') ?? Null;
        $age = $request->input('age') ?? Null;

        $id_user = Auth::guard('web')->user()->id;
        $user = User::findOrFail($id_user);
        $user->name = $name;
        $user->phone = $phone;
        $user->address = $address;
        $user->age = $age;
        $user->save();

        return redirect()->route('user.profile');   
   } 
}
