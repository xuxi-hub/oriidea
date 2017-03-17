@extends('layouts.default')

@section('title', '登录')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @include('shared._errors')

                <form id="formLogin" class="form-user form-login" method="post" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email">邮件地址：</label>
                        <input id="email" class="form-control" name="email" type="email" placeholder="邮件地址" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input id="password" class="form-control" name="password" type="password" placeholder="密码" value="{{ old('password') }}">
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" name="remember"> 记住我</label>
                     </div>

                    <button type="submit" class="btn btn-default">登录</button>
                    <hr>
                    <div>没有帐号？<a href="{{ route('signup') }}">立即注册</a></div>
                </form>
                <!-- formSignup **end -->
            </div>
        </div>
    </div>
@stop
