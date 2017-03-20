@extends('layouts.default')

@section('title', '重置密码')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @include('shared._errors')

                <form id="formReset" class="form-user form-password" method="post" action="{{ route('password.update') }}">
                    <!-- {{ csrf_field() }} -->
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="token" value="{{ $token }}">

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

                    <button type="submit" class="btn btn-default">重置密码</button>
                </form>
                <!-- formReset **end -->
            </div>
        </div>
    </div>
@stop
