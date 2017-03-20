@extends('layouts.default')

@section('title', '重置密码')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                @include('shared._errors')

                <form id="formPassword" class="form-user form-password" method="post" action="{{ route('password.reset') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="email">邮件地址：</label>
                        <input id="email" class="form-control" name="email" type="email" placeholder="邮件地址" value="{{ old('email') }}">
                    </div>

                    <button type="submit" class="btn btn-default">重置</button>
                </form>
                <!-- formPassword **end -->
            </div>
        </div>
    </div>
@stop
