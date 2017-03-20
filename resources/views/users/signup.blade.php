@extends('layouts.default')

@section('title', '注册')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @include('shared._errors')

                <form id="formSignup" class="form-user form-signup" method="post" action="{{ route('users.store') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">用户名：</label>
                        <input id="name" class="form-control" name="name" type="text" placeholder="用户名" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮件地址：</label>
                        <input id="email" class="form-control" name="email" type="email" placeholder="邮件地址" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input id="password" class="form-control" name="password" type="password" placeholder="密码" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input id="password_confirmation" class="form-control" name="password_confirmation" type="password" placeholder="确认密码" value="{{ old('password_confirmation') }}">
                    </div>

                    <p class="help-block">点击“注册”，即表示您同意遵守我们的《用户协议》、《隐私政策》及《Cookie 政策》。</p>
                    <button type="submit" class="btn btn-default">注册</button>
                    <hr>
                    <div>已有帐号？<a href="{{ route('login') }}">立即登录</a></div>
                </form>
                <!-- formSignup **end -->
            </div>
        </div>
    </div>
@stop
