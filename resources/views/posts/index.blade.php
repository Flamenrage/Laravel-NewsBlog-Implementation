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
    <h1>Список постов:</h1>
<ul>
    <li><a href="{{route('posts.show', ['post' => 1])}}">Post 1</a> <!--Тип ссылки по дефолту = GET-->
        <a href="{{route('posts.edit', ['post' => 1])}}">Изменить</a>
        <form action="{{route('posts.destroy', ['post' => 1])}}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit">Удалить</button>
        </form>
    </li> <!--попадаем в контроллер ресурсов posts =>
    метод show и вызываем его с аргументом 1-->
    <li><a href="{{route('posts.show', ['post' => 2])}}">Post 2</a>
        <a href="{{route('posts.edit', ['post' => 2])}}">Изменить</a></li>

    <li><a href="{{route('posts.show', ['post' => 3])}}">Post 3</a>
        <a href="{{route('posts.edit', ['post' => 3])}}">Изменить</a>
    </li>
    <li><a href="{{route('posts.show', ['post' => 4])}}">Post 4</a>
        <a href="{{route('posts.edit', ['post' => 4])}}">Изменить</a>
    </li>
    <li><a href="{{route('posts.show', ['post' => 5])}}">Post 5</a>
        <a href="{{route('posts.edit', ['post' => 5])}}">Изменить</a>
    </li>
</ul>
</body>
</html>
