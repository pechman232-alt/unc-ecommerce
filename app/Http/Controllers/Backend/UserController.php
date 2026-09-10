<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserRole;
use App\Services\Service;
use Hash;

class UserController extends Controller
{
    public function __construct(Service $service){
        $this->service = $service;
    }
    public function userList(){

        $permission = $this->service->permission();
        if(!$permission){
            return view('pages_not_found');
        }

        $users = User::selectRaw(
            'users.id,
            users.full_name,
            users.email,
            users.username,
            user_roles.name as role_name,
            user_roles.id as role_id,
            users.picture,
            users.created_by,
            users.updated_by,
            users.status
            '
        )
        ->join('user_roles','user_roles.id','=','users.role_id')
        ->where('users.status','=',1)
        ->get();
        return view('backend.Users.index',['users'=>$users]);
    }

    public function formCreateUser(){
        $userRoles = UserRole::get();
        return view('backend.Users.add_users',['userRoles'=>$userRoles]);
    }

    public function addUsers(Request $request, User $user){

        $request->validate([
            'full_name' => 'required',
            'username' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required',
            'password' => 'required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]+$/',
        ]);

        $user = new User();
        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role_id;
        $user->password = Hash::make($request->password);
        $user->status = 1;
        $user->created_by = auth('user')->user()->full_name;

        $file = $request->file('profile_image');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/userProfile/';
            $file->move(storage_path($file_dir), $name);
            $user->picture = $name;
        }

        $user->save();
        return redirect('users')->with('success','Users Added Successfully!');
    }

    public function editUsers($id){
        $ID = decrypt($id);
        $users = User::where('id', $ID)->first();
        $userRoles = UserRole::get();
        return view('backend.Users.edit_users',['userRoles'=>$userRoles,'users'=>$users]);
    }

    public function updateUsers(Request $request, $id){

        $ID = decrypt($id);
        $users = User::where('id', $ID)->firstorfail();
        $users->full_name = $request->full_name;
        $users->username = $request->username;
        $users->email = $request->email;
        $users->role_id = $request->role_id;

        if ($request->password !=""){
            $users->password = Hash::make($request->password);
        }

        $users->status = 1;
        $users->updated_by = auth('user')->user()->full_name;

        $file = $request->file('profile_image');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/userProfile/';
            $file->move(storage_path($file_dir), $name);
            $users->picture = $name;
        }

        $users->update();
        return redirect('users')->with('update','Users Updated Successfully!');
    }

    public function destroyUser($id){

        $ID = decrypt($id);
        $users = User::where('id', $ID)->first();
        $users->updated_by = auth('user')->user()->full_name;
        $users->status = 0;
        $users->update();
        return redirect()->back()->with('delete','Users Deleted Successfully!');
    }

    public function userProfile($path)
    {
        $storagePath = storage_path('/userProfile/'.$path);
        return response()->file($storagePath);
    }
}
