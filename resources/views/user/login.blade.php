@extends('layouts.layout')


@section('title')
    @parent::
    Authentication
@endsection

@section('header')
    @parent {{-- Если хотим дополнить секцию, то сначала пишем @parent, а потом добавляем, что хотим--}}
@endsection

@section('content')

    <div class="container mt-5">
        <div class="container">
            @include('layouts.alerts')
        </div>
        <form method="post" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"></input>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"></input>
            </div>

            <button type="submit" class="btn btn-primary"> Send </button>
        </form>
    </div>

@endsection


