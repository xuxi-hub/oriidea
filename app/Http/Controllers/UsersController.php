<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;

use Auth;
use Mail;

class UsersController extends Controller
{

    public function __construct()
    {
        //使用身份验证（Auth）中间件来过滤未登录用户的 edit, update, destroy, followings, followers 动作
        $this->middleware('auth', [
            'only' => ['edit', 'update', 'destroy', 'followings', 'followers']
        ]);

        // 只让未登录用户访问注册页面
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function index()
    {
        // $users = User::all();
        // 调用 paginate 方法，在用户列表页上渲染分页链接。
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    // 加载注册页
    public function create()
    {
        return view('users.signup');
    }

    // 用户个人资料
    public function show($id)
    {
        $user = User::findOrFail($id);

        // 添加微博动态的读取逻辑
        $statuses = $user->statuses()
                         ->orderBy('created_at', 'desc')
                         ->paginate(30);
        return view('users.show', compact('user', 'statuses'));
    }

    // 用户注册验证与存储
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        /**
        * 未添加邮件验证，直接注册成功
        * Auth::login($user); // 注册成功后自动登录

        * session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        * return redirect()->route('users.show', [$user]);
        */

        // 添加邮件验证
        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');
    }

    // 用户个人资料编辑
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('update', $user); // 使用 authorize 方法来验证用户授权策略
        return view('users.edit', compact('user'));
    }

    // 更新
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'confirmed|min:6'
        ]);

        $user = User::findOrFail($id);
        $this->authorize('update', $user); // 使用 authorize 方法来验证用户授权策略

        // $user->update([
        //     'name' => $request->name,
        //     'password' => bcrypt($request->password)
        // ]);

        // 拆分，提供空白密码也能通过验证
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $id);
    }

    // 删除用户
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('destroy', $user); // 使用 authorize 方法来验证用户授权策略
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }

    // 发送邮件验证
    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = '778022227@qq.com';
        $name = 'Symon';
        $to = $user->email;
        $subject = "感谢注册 Oriidea 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    // 邮件验证成功
    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user); // 验证通过后自动登录
        session()->flash('success', '恭喜，激活成功！');
        return redirect()->route('users.show', [$user]);
    }

    // 粉丝
    public function followers($id)
    {
        $user = User::findOrFail($id);
        $users = $user->followers()->paginate(10);
        $title = '粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }

    // 关注的人
    public function followings($id)
    {
        $user = User::findOrFail($id);
        $users = $user->followings()->paginate(10);
        $title = '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

}
