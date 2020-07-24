@extends('layouts.master')
@section('content')
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Todo App
                </div>

                <form class="form" action=" {{ route('update') }} " method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="hidden" name="id" value="{{ $task->id }}">
                        <label>Edit Tugas</label>
                        <input type="text" name="name" class="form-control" value="{{ $task->name }}">
                    </div>
                    <button class="btn btn-warning">Edit</button>
                </form>

            </div>
        </div>
@endsection