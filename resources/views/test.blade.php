<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
{{--{!! $h1 !!}--}} <br> <!--Без обработки функцией htmlspecialchars()-->
<h1> {{ $title }}</h1>
    {{--
     Вариант @{{ title }}
     позволяет обработать title другим фреймворком, например js, blade его проигнорирует
     директива @verbatim {{title}} @endverbatim позволяет не писать везде знак доллара
     --}}
    {{-- @if(count($data1) > 20)
        Count > 20
    @elseif(count($data1) < 20)
        Count < 20
    @else
        Count = 20
    @endif--}}
    {{--@isset($data1)
        Isset data1
    @endisset--}}
    {{--@for($i = 0; $i < count($data1); $i++)
        @if($data1[$i] % 2 == 0)
            {{ $data1[$i] }}
        @endif
    @endfor
    <br>
    @for($i = 0; $i < count($data1); $i++)
        @if($data1[$i] % 2 != 0) --}}{{--пропускаем нечетные цифры--}}{{--
            @continue --}}{{-- @break - остановить --}}{{--}
        @endif
            {{ $data1[$i] }}
    @endfor
    <br>
    @foreach($data2 as $k => $v)
        {{ $k }} => {{ $v }} <br>
    @endforeach--}}
</body>
</html>
