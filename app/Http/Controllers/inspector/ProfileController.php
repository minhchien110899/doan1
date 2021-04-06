<?php

namespace App\Http\Controllers\inspector;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Inspector;
use Storage;

class ProfileController extends Controller
{
    public function __construct(){
    	$this->middleware('auth:inspector');
    }

    public function index(){
    	$id_inspector = Auth::guard('inspector')->user()->id;
    	$inspector = inspector::find($id_inspector); 
    	return view('inspector.profile', ['inspector' => $inspector]);
    }

    public function change_info(Request $request, $id){
    	$name = $request->input('name');
        $phone = $request->input('phone') ?? Null;
        $address = $request->input('address') ?? Null;
        $age = $request->input('age') ?? Null;

        $inspector = inspector::find($id);
        $inspector->name = $name;
        $inspector->phone = $phone;
        $inspector->address = $address;
        $inspector->age = $age;
        $inspector->save();
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
        //     $path = $request->file('avatar')->storeAs('public/avatar-inspector', $name_stored);
        // }
        if($request->hasFile('avatar')):
            $new_avatar = $request->file('avatar')->store('avatar-inspector', 's3');
            Storage::disk('s3')->setVisibility($new_avatar, 'public');
        endif;
        $inspector = inspector::findOrFail($id);
        $old_avatar = $inspector->avatar ?? Null;
        if($old_avatar){
            Storage::disk('s3')->delete($old_avatar);
        }
        $inspector->avatar = Storage::disk('s3')->url($new_avatar);
        $inspector->save();

        return redirect()->back()->with('success', 'Cập nhập ảnh đại diện thành công.');
    }
}
