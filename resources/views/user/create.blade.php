@extends('layouts.layout')


@section('title')
    @parent::
    Registration
@endsection

@section('header')
    @parent {{-- Если хотим дополнить секцию, то сначала пишем @parent, а потом добавляем, что хотим--}}
@endsection

@section('content')

    <div class="container mt-5">
        <div class="container">
            @include('layouts.alerts')
        </div>
        <form method="post" action="{{ route('register.store') }}"
              enctype="multipart/form-data"> {{-- enctype="multipart/form-data" при загрузке изображений обязательна--}}
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}"></input>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"></input>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"></input>
            </div> {{--password_confirmation - laravel видит это поле и сразу при валидации чекает совпадение между паролями --}}
            <div class="form-group">
                <label for="avatar">Аватар</label>
                <input type="file" class="form-control-file" id="avatar" name="avatar"></input>
            </div>
            <button type="submit" class="btn btn-primary"> Send </button>
        </form>
    </div>

@endsection


