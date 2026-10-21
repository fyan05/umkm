<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
     public function index(){
        return view('admin.admin-login');
    }
    public function member(){
        return view('member-login');
    }

    public function auth(Request $request){
        $validation= $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($validation)){
            return redirect()-> intended('admin');
        }
        return redirect()->back()->with('messages','Login gagal');
    }
    public function authMember(Request $request){
        $validation= $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($validation)){
            return redirect()-> intended('/');
        }
        return redirect()->back()->with('messages','Login gagal');
    }
    public function logout(){
        Auth::logout();
        return redirect('/admin/login');
    }
    public function logoutMember(){
        Auth::logout();
        return redirect('/member/login');
    }
}
