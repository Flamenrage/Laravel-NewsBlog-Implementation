@extends('layouts.layout')


@section('title')
    @parent::
    Create
@endsection

@section('content')
    <section
        style="margin-bottom: 10px !important;
               padding-bottom: 0px !important;"
        class="jumbotron text-center">
        <div class="container">
            <h1> {{ $title }}</h1>
        </div>
    </section>
    <div class="container">
        @include('layouts.alerts')
    </div>
    <div class="container">
        <form class="mt-5" method="post" action="{{route('posts.store')}}">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control mb-1 @error('title') is-invalid @enderror" id="title"
                       placeholder="Title"
                       name="title" value="{{ old('title') }}">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> <!--Чтобы ошибки не пропадали используем значения flash переменных old('variable')-->
            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control mb-1 @error('content') is-invalid @enderror" id="content" rows="3"
                          name="content" placeholder="Content">{{old('content')}}</textarea>
                @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="rubric_id">Rubric</label>
                <select class="form-control mb-1 @error('rubric_id') is-invalid @enderror" id="rubric_id"
                        name="rubric_id">
                    <option>Select Rubric</option>
                    @foreach($rubrics as $k => $v)
                        <option value="{{ $k }}"
                                @if(old('rubric_id') == $k) selected @endif
                        >{{ $v }}</option>
                    @endforeach
                </select>
                @error('rubric_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
