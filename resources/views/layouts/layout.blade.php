<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>@section('title') My site @show</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="{{asset('css/styles.css')}}" rel="stylesheet">
</head>
<body>
<header>
    @section('header')
        <div class="collapse bg-dark" id="navbarHeader">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-md-7 py-4">
                        <h4 class="text-white">About</h4>
                        <p class="text-muted">Add some information about the album below, the author, or any other background context. Make it a few sentences long so folks can pick up some informative tidbits. Then, link them off to some social networking sites or contact information.</p>
                    </div>
                    <div class="col-sm-4 offset-md-1 py-4">
                        <h4 class="text-white">Contact</h4>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}" class="text-white">Home</a></li>
                            <li><a href="{{ route('page.about') }}" class="text-white">About</a></li>
                            <li><a href="{{ route('posts.create') }}" class="text-white">Create</a></li>
                            @if (Auth::check())
                                <li><a href="#" class="text-white">{{auth()->user()->name}}
                                    </a>
                                    @if(auth()->user()->avatar)
                                        <img src="{{asset('storage/' . auth()->user()->avatar)}}"
                                             class="rounded-circle"
                                             height="30"
                                             width="30"
                                             alt="">
                                    @endif
                                </li>
                                <li><a href="{{ route('login.logout') }}" class="text-white">Leave</a></li>
                            @elseif(!Auth::check())
                            <li><a href="{{ route('register.create') }}" class="text-white">Sign up</a></li>
                            <li><a href="{{ route('login.create') }}" class="text-white">Sign in</a></li>
                            @endif
                            {{-- Или используем @auth @endauth для авторизованных пользователей --}}
                            {{-- Или используем @guest @endguest для неавторизованных пользователей --}}

                            @php
                            //dump(Auth::check());
                            //dump(auth()->check());
                            @endphp
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar navbar-dark bg-dark shadow-sm">
            <div class="container d-flex justify-content-between">
                <a href="{{ route('home') }}" class="navbar-brand d-flex align-items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="mr-2" viewBox="0 0 24 24" focusable="false"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
                    <strong>Album</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    @show {{-- Объявляем секцию и показываем сразу --}}
</header>

<main role="main">

    @yield('content') {{--yield - куда вставляем, section - что вставляем--}}

</main>

@include('layouts.footer') {{-- Включаемая часть --}}

<script src="{{asset('js/scripts.js')}}"></script>
<script>
    $(function(){
         //$('[data-toggle="tooltip"]').tooltip();
    });
</script>
</html>
