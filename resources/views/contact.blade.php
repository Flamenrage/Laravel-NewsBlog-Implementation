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
<form action="{{ route('contact_page') }}" method="post">
    {{-- {{ csrf_field() }} --}}
    {{-- protect page value from fake name --}}
    {{-- Если нам нужны скрытые поля с разными видами запросов, то https://laravel.com/docs/8.x/routing#form-method-spoofing,
     http://semantic-portal.net/concept:106--
      при определении маршрутов в route_service PUT, PATCH или DELETE, которые вызываются из HTML-формы ,
      вам нужно будет добавить в форму скрытое поле _method
      Значение, отправленное с полем _method, будет использоваться в качестве метода HTTP-запроса }}
    {{-- {{method_field('PUT')}} - 1 вариант --}}
    {{-- @method('PUT') - 2 вариант --}}
    @csrf
    <input type="text" name="name">
    <input type="email" name="email">
    <button type="submit">Submit</button>
</form>
</body>
</html>
