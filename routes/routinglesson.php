<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Сначала идут конкретные случаи маршрутизации, а после общие правила

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/contact', function () {
//    return view('contact');
//});
//
//Route::post('/send_email', function () {
//    if (!empty($_POST)) {
//        dump($_POST);
//    }
//    return'send Email';
//});

Route::match(['get', 'post', 'put'], '/contact', function () {
    if (!empty($_POST)) {
        dump($_POST);
    }
    return view('contact');

})->name('contact_page'); //именованный запрос, чтобы меняя url не менять его во всех местах

//Route::any - поддержка всех видов запросов без их указания, маршрут доступен по любому запросу


Route::get('/home', function () {
    $var = 15;
    $name = 'John';
    //1 variant
    // return view('home', ['var'=>$var, 'name'=>$name]);
    //2 variant
    return view('home', compact('var', 'name'));
})->name('home');

Route::view('/test_page', 'test', ['test' => 'Test data']); //упрощенная версия роутинга для статичных страниц
Route::view('/begin', 'begin');

//перемещение с одной страницы на другую
Route::redirect('/begin', '/contact'); //3м параметром может быть передаваемый статус, например 301
//permanentRedirect - постоянный редирект, по дефолту возвращает 301 статус страницы

Route::get('/post/{id}/{slug}', function ($id, $slug){ // id = [0-9a-z_]
    return "Post $id, $slug"; // slug = Тест => test
})->where(['id' => '[0-9a-z]+', 'slug' => '[A-Za-z0-9-]+']); //если параметр 1 = 'id', '[0-9a-z]+'
//https://laravel.com/docs/8.x/helpers#method-fluent-str-slug
//глобальное прописывание правил маршрута в app => providers => route service provider (метод boot)
//если правила маршрута прописаны глобально, локально where прописывать не нужно

Route::prefix('admin')->name('admin.')->group(function(){ //сгруппированные запросы с префиксом admin
    Route::get('/posts', function () {
        return 'Posts list';
    });

    Route::get('/post/create', function () {
        return 'Post create';
    });

    Route::get('/post/{id}/edit', function ($id) {
        return "Post $id edit";
    })->name('post'); //admin.post
}); //данные маршруты будут доступны по имени admin. (имя группы)

Route::get('/table/{id}/{slug?}', function ($id, $slug = null){ // необязательные параметры, ставим ? рядом
    //и прописываем дефолтное значение для параметра
    return "Table $id, $slug";
})->name('Table');

//fallback - перенаправление несуществующих адресов на существующий, нужный адрес
Route::fallback(function(){
    // return redirect()->route('home');
    //если мы хотим показывать 404 страницу
    abort(404, 'Oops! Page not found');
});

Route::get('/', [ HomeController::class, 'index' ]);
Route::get('/test', [ HomeController::class, 'test' ]);
Route::get('/page/{slug}', [ PageController::class, 'show' ]); //slug - параметр для страницы
Route::get('/test2', [ TestController::class, 'index' ]);

Route::resource('/posts', PostController::class, ['parameters' => [
    'posts' => 'id' //мы глобально переименовали posts в id для контролирования регекса id в url адресе
    // (см routeserviceprovider)
]]);



//fallback - перенаправление несуществующих адресов на существующий, нужный адрес
Route::fallback(function(){
    // return redirect()->route('home');
    //если мы хотим показывать 404 страницу
    abort(404, 'Oops! Page not found');
});
