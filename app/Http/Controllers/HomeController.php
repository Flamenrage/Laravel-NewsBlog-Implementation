<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\City;

use App\Models\Post;
use App\Models\Rubric;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // \Debugbar:warning('I'm gonna sing to you forever');
        $rubs = Rubric::all();
        /*if (Cache::has('posts')) {
            $posts=Cache::get('posts');
        }
        else {*/
        $posts = Post::query()->orderBy('created_at', 'desc')->paginate(9); //appservice -> usebootstrap
        //simplePaginate = назад, вперёд
        //$posts = Post::query()->orderBy('id', 'desc')->get();
            Cache::put('posts', $posts);
        //}

        $title = 'Home Page';


        return view('home', compact('title', 'posts', 'rubs'));
    }

    public function cookie_method(Request $request)
    {
        /* Cookie используются через Request или через Facade, попробуем создать печеньку 2м методом */
        /* Нельзя создать/удалить, если она выводится */
        Cookie::queue('test', 'Test cookie', 5); // test: Test cookie, 1 минута длительность
        dump(Cookie::get('test')); // вывод
        dump($request->cookie('test'));
        Cookie::queue(Cookie::forget('test')); // удаление cookie
        //мы можем взять данные из кэша и удалить сам кэш после просмотра
        Cache::put('key', 'value', 360);
        //dump(Cache::get('key'));
        //dump(Cache::pull('key')); //посмотрим и удалим
        //Cache::forget('key'); // удаляем полностью
        //Cache::flush(); // очищаем кэш полностью
    }

    public function cache_method(){
        /* Cache */
        // storage/framework/cache/data
        //Cache::put('key', 'value', 60); // кол-во секунд
        //dump(Cache::get('key'));
        //мы можем положить данные в кэш бесссрочно, не передавая время 3 параметром
        //или используя метод forever
    }

    public function blade_method()
    {
        $title = 'Home Page';
        $h1 = '<h1>Welcome to our app!</h1>';
        $data1 = range(1, 20);
        $data2 = [
            'title' => 'Title',
            'content' => 'Content',
            'keys' => 'Keywords'
        ];
        return view('home', compact('title', 'h1', 'data1', 'data2'));
    }

    public function test()
    {
        //return view('test');
        return __METHOD__; // - название метода контроллера
    }

    public function create()
    {
        $title = 'Create Page';
        $rubrics = Rubric::pluck('title', 'id');
        return view('create', compact('title', 'rubrics'));
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $content = $request->input('content');
        $rubric = $request->input('rubric_id');
        /* Валидация данных */
        $rules = [
            'title' => 'required|max:100|min:5', // |unique:posts - уникальный среди постов
            'content' => 'required|max:255|min:5',
            'rubric_id' => 'integer' // 'email' => 'regex:/^.+@.+$/i' - пример для email
        ];
        $messages = [
            'title.required' => 'Заполните поле "название"',
            'title.min' => 'Должно быть минимум 5 символов в поле "название"',
            'rubric_id.integer' => 'Выберите рубрику из списка',
        ];
        // $validator = Validator::make($request->all(), $rules, $messages)->validate();
        $this->validate($request, $rules);
        $form = $request->all();
        Post::query()->create($request->all());
        $request->session()->flash('success', 'Данные сохранены');
        //Это сообщение будет доступно 1 раз при редиректе, покажется и удалится из хранилища
        return redirect()->route('home');
    }

}
