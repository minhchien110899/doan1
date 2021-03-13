<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Admin;
use Storage;
class ProfileController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:admin');
    }

    public function index(){
    	$id_admin = Auth::guard('admin')->user()->id;
    	$admin = Admin::find($id_admin); 
    	return view('admin.profile', ['admin' => $admin]);
    }

    public function change_info(Request $request, $id){
    	$name = $request->input('name');
        $phone = $request->input('phone') ?? Null;
        $address = $request->input('address') ?? Null;
        $age = $request->input('age') ?? Null;

        $admin = Admin::find($id);
        $admin->name = $name;
        $admin->phone = $phone;
        $admin->address = $address;
        $admin->age = $age;
        $admin->save();
        return redirect()->back();
    }

    public function change_avatar(Request $request, $id){
    	$request->validate([
            'avatar' =>'image|required',
        ],[
            'avatar.image' => 'File phải là file ảnh.',
        ]);

        // if($request->hasFile('avatar')){
        //     $name_stored = $request->file('avatar')->hashName();
        //     //upload file
        //     $path = $request->file('avatar')->storeAs('public/avatar-admin', $name_stored);
        // }
        if($request->hasFile('avatar')):
            $new_avatar = $request->file('avatar')->store('avatar-admin', 's3');
            Storage::disk('s3')->setVisibility($new_avatar, 'public');
        endif;
        $admin = Admin::findOrFail($id);
        $old_avatar = $admin->avatar ?? Null;
        if($old_avatar){
            Storage::disk('s3')->delete($old_avatar);
        }
        $admin->avatar = Storage::disk('s3')->url($new_avatar);
        $admin->save();

        return redirect()->back()->with('success', 'Cập nhập ảnh đại diện thành công.');
    }
}
