<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\Menus;
use App\Models\User;
use App\Models\ActiveMenu;
use App\Services\Service;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    public function __construct(Service $service){
        $this->service = $service;
    }
    public function listUserRole(){

        $permission = $this->service->permission();
        if(!$permission){
            return view('pages_not_found');
        }

        $userRole = UserRole::get();
        return view('backend.UsersRole.index',['userRole'=>$userRole]);
    }

    public function addRole(){

        $permission = $this->service->permission();
        if(!$permission){
            return view('under_maintenance');
        }

        $mainMenus = Menus::where('sub_of','0')->get();
        $subMenus = Menus::where('sub_of','!=','0')->get();
        return view('backend.UsersRole.add_role',['mainMenus'=>$mainMenus, 'subMenus'=>$subMenus]);
    }

    public function createRole(Request $request){

        if(Auth::guard('user')->check()){

            $request->validate([
                'role_name' => 'required'
            ]);
    
            $role_name = $request->role_name;
            $ch_main = $request->ch_main;
            $ch_sub = $request->ch_sub;
    
            $userRole = new UserRole();
            $userRole->name = $role_name;
            $userRole->save();
    
            if(!empty($ch_main)) {
                for($i = 0; $i < count($ch_main); $i++){
                    $main = New ActiveMenu();
                    $main->role_id = $userRole->id;
                    $main->menu_id = $ch_main[$i];
                    $main->save();
                }
            }
    
            if(!empty($ch_sub)) {
                for($i = 0; $i < count($ch_sub); $i++){
                    $main = New ActiveMenu();
                    $main->role_id = $userRole->id;
                    $main->menu_id = $ch_sub[$i];
                    $main->save();
                }
            }
    
            return redirect('user-role')->with('success', 'Role updated successfully!');

        } else {
            return redirect('admin-login');
        }

    }

    public function editRole($id){

        $ID = decrypt($id);
        if(Auth::guard('user')->check()){
            $data = ActiveMenu::where('role_id', $ID)->get();
            $userRole = UserRole::where('id', $ID)->first();
            $mainMenus = Menus::where('sub_of','0')->get();
            $subMenus = Menus::where('sub_of','!=','0')->get();

            foreach($mainMenus as $i1 => $m) {
                foreach($data as $i2 => $d) {
                    if($m->id == $d->menu_id) {
                        $mainMenus[$i1]['checked'] = "1";
                    } 
                }
            }

            foreach($subMenus as $i1 => $m) {
                foreach($data as $i2 => $d) {
                    if($m->id == $d->menu_id) {
                        $subMenus[$i1]['checked'] = "1";
                    } 
                }
            }
            return view('backend.UsersRole.edit_role',['mainMenus'=>$mainMenus,'subMenus'=>$subMenus,'userRole'=>$userRole]);
        } else {
            return redirect('admin-login');
        }
    }

    public function updateRole(Request $request, $id){

        $ID = decrypt($id);
        
        $role_name = $request->role_name;
        $ch_main = $request->ch_main;
        $ch_sub = $request->ch_sub;

        $userRole = UserRole::where('id', $ID)->firstorfail();
        $userRole->name = $role_name;
        $userRole->save();

        $main_d = ActiveMenu::where('role_id', $ID)->delete();

        if(!empty($ch_main)) {
            for($i = 0; $i < count($ch_main); $i++){
                $main = New ActiveMenu();
                $main->role_id = $userRole->id;
                $main->menu_id = $ch_main[$i];
                $main->save();
            }
        }

        if(!empty($ch_sub)) {
            for($i = 0; $i < count($ch_sub); $i++){
                $main = New ActiveMenu();
                $main->role_id = $userRole->id;
                $main->menu_id = $ch_sub[$i];
                $main->save();
            }
        }

        $activeMenus = ActiveMenu::selectRaw(
            'menus.id as menuid,
                menus.name as menuName,
                menus.route,
                menus.icon
                ',
        )
            ->join('menus', 'menus.id', '=', 'active_menus.menu_id')
            ->where('active_menus.role_id', auth('user')->user()->role_id)
            ->where('menus.sub_of', '=', '0')
            ->get();

        session()->put('activeMenus', $activeMenus);

        $activeSubMenus = ActiveMenu::selectRaw(
            'menus.id as menu,
                menus.name as menuName,
                menus.sub_of,
                menus.route
                ',
        )
            ->join('menus', 'menus.id', '=', 'active_menus.menu_id')
            ->where('active_menus.role_id', auth('user')->user()->role_id)
            ->where('menus.sub_of', '!=', '0')
            ->get();

        session()->put('activeSubMenus', $activeSubMenus);

        return redirect('user-role')->with('update', 'Role updated successfully!');
    }

    public function destroyRole($id){
        $ID = decrypt($id);
        $users = User::where('role_id', $ID)->get();
        if ( count($users) < 1){
            $data = ActiveMenu::where('role_id', $ID)->delete();
            $userRole = UserRole::where('id', $ID)->delete();
            return redirect('user-role')->with('delete', 'Role deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'This role are already in used.');
        }
    }
}
