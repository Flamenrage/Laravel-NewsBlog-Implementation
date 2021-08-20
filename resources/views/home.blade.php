@extends('layouts.layout')


@section('title')
    @parent::
    {{ $title }}
@endsection

@section('header')
    @parent {{-- Если хотим дополнить секцию, то сначала пишем @parent, а потом добавляем, что хотим--}}
@endsection

@section('content')
    <section class="jumbotron text-center">
        <div class="container">
            @include('layouts.alerts')
        </div>
        <div class="container">
            {{--{!! $h1 !!}--}} <br> <!--Без обработки функцией htmlspecialchars()-->
            <h1> {{ $title }}</h1>

        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">
            <div class="row">
                @foreach($posts as $post)
                    <div class="col-md-4">
                        <div class="card mb-4 shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                 xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice"
                                 focusable="false"
                                 role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"/>
                                <text x="50%" y="50%" fill="#eceeef" dy=".3em">{{$post->title}}</text>
                            </svg>
                            <div class="card-body">
                                <p class="card-text">{{$post->content}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                    </div>
                                    <small class="text-muted" data-toggle="tooltip" data-placement="left"
                                           title="{{$post->getIntlDate()}}">{{--{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $post->created_at)->format('d M Y')}}--}}
                                        {{ $post->getFirstDate() }}
                                    </small>
                                    {{--Поменять локализацию app->config->app.php, locale='ru'--}}
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="container centered" style="padding-left: 40% !important;">
                    {{--$posts->appends(['test' => request()->test])->links()--}}
                    {{-- http://127.0.0.1:8000/?test=123&page=2 для сохранения параметров      --}}
                    {{-- ->fragment('foo') = 8000/?test=123&page=2#foo --}}
                    {{-- onEachSide (количество отображаемых ссылок) --}}
                    {{-- $paginator->links('view.name') - задать собственное отображение для ссылок--}}
                    {{$posts->links('vendor.pagination.my-pages')}}

                </div>
            </div>
        </div>

    </div>
@endsection
