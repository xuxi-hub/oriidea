<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class SessionsController extends Controller
{

    public function create()
    {
        return view('sessions.login');
    }

    // 登录
    public function store(Request $request)
    {
       $this->validate($request, [
           'email' => 'required|email|max:255',
           'password' => 'required|min:6'
       ]);

       $credentials = [
           'email'    => $request->email,
           'password' => $request->password,
       ];

       // 帐号、密码验证
       if (Auth::attempt($credentials, $request->has('remember'))) {

           // 该用户存在于数据库，且邮箱和密码相符合，登录成功
           session()->flash('success', '欢迎回来！');
           return redirect()->route('users.show', [Auth::user()]);

       } else {

           // 登录失败
           session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
           return redirect()->back();

       }

       return;
    }

    // 退出登录
    public function destroy()
    {
        Auth::logout();

        session()->flash('success', '已成功退出！');
        return redirect('login');
    }

}
