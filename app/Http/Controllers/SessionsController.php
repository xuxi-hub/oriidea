<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;

class SessionsController extends Controller
{

    // 只让未登录用户访问登录页面
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    // 加载登录页
    public function create()
    {
        return view('sessions.login');
    }

    // 登录验证与存储
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

           // 添加邮件激活验证
           if(Auth::user()->activated) {
               // 该用户存在于数据库，且邮箱和密码相符合，登录成功
               session()->flash('success', '欢迎回来！');
               // return redirect()->route('users.show', [Auth::user()]);
               /*
               * 使用 intended 方法实现更友好的转向。
               * 将页面重定向到上一次请求尝试访问的页面上，并接收一个默认跳转地址参数，
               * 当上一次请求记录为空时，跳转到默认地址上。
               */
               return redirect()->intended(route('users.show', [Auth::user()]));
           } else {
               // 邮件未激活，跳转到首页并给予提示
               Auth::logout();
               session()->flash('warning', '你的账号未激活，请检查邮箱中的注册邮件进行激活。');
               return redirect('/');
           }

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
