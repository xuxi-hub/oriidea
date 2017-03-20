@extends('layouts.default')

@section('title', $user->name)

@section('content')
    <div class="container">
        <section class="user-info">
            @include('shared._user_info', ['user' => $user])
        </section>
        <section calss="user-statuses">
            @if (count($statuses) > 0)
                <ol class="statuses">
                    @foreach ($statuses as $status)
                        @include('statuses._status')
                    @endforeach
                </ol>
                
                {!! $statuses->render() !!}
            @endif
        </section>
    </div>
@stop
