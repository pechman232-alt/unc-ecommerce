<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ActiveMenu;
use Illuminate\Support\Facades\Hash;

class BackEndLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/home';

    public function __construct()
    {
      $this->middleware('guest')->except('logout');
    }

    public function guard()
    {
     return Auth::guard('user');
    }

    public function index(){
        return view('backend.layouts.back-auth');
    }

    public function login(Request $request) {

        $username = $request->username;
        $password = $request->password;

        $user = User::where('username', $username)->first();
        if(!empty($username && $password)){
            if (!empty($user) && $user->status == 1) {
                if(Hash::check(($password), optional($user)->password)){
                    if(Auth::guard('user')->loginUsingId($user->id, true)){

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
                        
                        // session(['activeMenus' => $activeMenus]);

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
                        // session(['activeSubMenus' => $activeSubMenus]);
                        
                        return redirect('admin-unc')->with('success', 'Active');
                    } else {
                        return redirect()->back()->with('error', 'Something went wrong!');
                    }
                } else {
                    return redirect()->back()->with('error', 'Your Password is incorrect!');
                }
            } else {
                return redirect()->back()->with('delete', 'Your Account Inactive!');
            }
        } else {
            return redirect()->back()->with('error', 'Please Enter Your Username and Password!');
        }
    }

    public function logout(Request $request){
        Auth('user')->logout();
        // session()->remove('activeSubMenus');
        // session()->remove('activeMenus');
        return redirect('admin-login');
    }

}