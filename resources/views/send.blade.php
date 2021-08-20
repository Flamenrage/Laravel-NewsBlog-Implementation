@extends('layouts.layout')


@section('title')
    @parent::
    Letter
@endsection

@section('header')
    @parent {{-- Если хотим дополнить секцию, то сначала пишем @parent, а потом добавляем, что хотим--}}
@endsection

@section('content')

    <div class="container mt-5">
        <div class="container">
            @include('layouts.alerts')
        </div>
        <form method="post" action="/send">
            @csrf
            <div class="form-group">
                <label for="name">Your name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" class="form-control" id="email" name="email"></input>
            </div>
            <div class="form-group">
                <label for="text">Your message</label>
                <textarea class="form-control" id="text" rows="5" name="text"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"> Send </button>
        </form>
    </div>

@endsection


