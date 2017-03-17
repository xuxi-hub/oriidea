<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\User;

use Auth;

class UsersController extends Controller
{

    public function __construct()
    {
        //使用身份验证（Auth）中间件来过滤未登录用户的 edit, update, destroy 动作
        $this->middleware('auth', [
            'only' => ['edit', 'update', 'destroy']
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
        return view('users.show', compact('user'));
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

        Auth::login($user); // 注册成功后自动登录

        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
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

}
