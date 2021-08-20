<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\MainController;

use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Test\TestController;



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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'guest'], function() {
    Route::get('/register', [UserController::class, 'create'])->name('register.create'); //создаем и открываем форму
    Route::post('/register', [UserController::class, 'store'])->name('register.store'); //сохраняем и отправляем данные с формы
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create'); //создаем и открываем форму
    Route::post('/login', [UserController::class, 'login'])->name('login'); //сохраняем и отправляем (принимаем) данные с формы
}); //разрешаем переходить на эти страницы для гостя
Route::group(['middleware' => 'admin', 'prefix'  => 'admin'], function() {
    Route::get('/', [MainController::class, 'index'])->middleware('admin');
});
Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout', [UserController::class, 'logout'])->name('login.logout'); //выйти из кабинета
});
Route::post('/', [HomeController::class, 'store'])->name('posts.store');
Route::get('/create', [HomeController::class, 'create'])->name('posts.create');
Route::get('/page/about', [ PageController::class, 'show' ])->name('page.about');
Route::match(['get', 'post'], '/send', [ContactController::class, 'send']);
 //переадресация только через посредника


