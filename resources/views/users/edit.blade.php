@extends('layouts.default')

@section('title', '更新个人资料')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @include('shared._errors')

                <div class="gravatar_edit">
                    <a href="http://gravatar.com/emails" target="_blank">
                        <img src="{{ $user->gravatar('120') }}" alt="{{ $user->name }}" class="gravatar"/>
                    </a>
                </div>

                <form id="formProfileEdit" class="form-user form-profile-edit" method="post" action="{{ route('users.update', $user->id) }}">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="name">用户名：</label>
                        <input id="name" class="form-control" name="name" type="text" placeholder="用户名" value="{{ $user->name }}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮件地址：</label>
                        <input id="email" class="form-control" name="email" type="email" placeholder="邮件地址" value="{{ $user->email }}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input id="password" class="form-control" name="password" type="password" placeholder="密码" value="{{ old('password') }}">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input id="password_confirmation" class="form-control" name="password_confirmation" type="password" placeholder="确认密码" value="{{ old('password_confirmation') }}">
                    </div>

                    <button type="submit" class="btn btn-default">更新</button>
                </form>
                <!-- formProfileEdit **end -->
            </div>
        </div>
    </div>
@stop
