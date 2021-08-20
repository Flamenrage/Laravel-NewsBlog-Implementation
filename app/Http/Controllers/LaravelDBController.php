<?php


namespace App\Http\Controllers;


class LaravelDBController extends Controller
{
    public function index(){
        // Вставка - DB::insert("INSERT INTO posts (title, content) VALUES (?, ?) ", ['Article 3', 'This article 3 is about the past of the Earth.']);
        // Обновление - DB::update("UPDATE posts SET title = ?, content = ? WHERE id = 1", ['First Article', 'Hello, it is my blog']);
        // для проверки результата запроса - var_dump($query);
        // statement - изменение структуры таблицы, а не работы с данными и тд
        /* Транзакция (проверка корректного изменения нескольких ячеек - например, дата и число)
         * DB::beginTransaction();
        try {
            DB::update(//);
            //..
            DB::update(//);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            echo $e->getMessage();
        }*/
        // $posts = DB::select("SElECT * FROM posts WHERE id >= :id", ['id' => 1]); //NOW() для created_at and updated_at, :id - именованный парамтр
        // return view('home', ['var' => 3, 'name' => 'Hello']);
    }
}
