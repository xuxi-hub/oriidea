@extends('layouts.default')

@section('title', '更新个人资料')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <ul class="users-list">

                    @foreach ($users as $user)
                        @include('users._user')
                    @endforeach

                </ul>

                {!! $users->render() !!}
            </div>
        </div>
    </div>
@stop
