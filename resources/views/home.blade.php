@extends('layouts.app') @section('content')
<div>
    <div
        class="w-100 h-100 d-flex flex-column align-items-center justify-content-center"
    >
        <h1 class="text-white todos-headers">Welcome to Tic-tac-do!</h1>
        <h4 class="text-white todos-headers">
            Where all of your todos are easily organized
        </h4>
        @if(Auth::check())
        <todo-component :user="{{Auth::user()}}"></todo-component>
        @endif
    </div>
</div>
@endsection
