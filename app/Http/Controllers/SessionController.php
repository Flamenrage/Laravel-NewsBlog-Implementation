<?php


namespace App\Http;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('Test', 'Test Value'); //Key, Value
        session(['cart' =>
            [
                ['id' => 1, 'title' => 'Product 1'],
                ['id' => 2, 'title' => 'Product 2'],
            ]
        ]); // Добавляет в сессию, хранятся в файловом хранилище storage/framework/session
        /*
          "Test" => "Test Value"
          "cart" => array:2 [▼
            0 => array:2 [▼
              "id" => 1
              "title" => "Product 1"
            ]
            1 => array:2 [▼
              "id" => 2
              "title" => "Product 2"
            ]
          ]
        ]
        */
        dump(session('Test')); //  "Test Value"
        dump(session('cart')[0]['title']); //  "Product 1"
        dump($request->session()->get('cart')[1]['title']); // "Product 2"
        //dump($request->session()->all());
        /* Добавление данных */
        $request->session()->push('cart', ['id' => 3, 'title' => 'Product 3']);
        /*
              "cart" => array:3 [▼
                0 => array:2 [▶]
                1 => array:2 [▶]
                2 => array:2 [▼
                  "id" => 3
                  "title" => "Product 3"
                ]
               ]
        */
        /* Удаление данных */
        dump($request->session()->pull('cart', ['id' => 3, 'title' => 'Product 3']));//  Прочитать и удалить запись
        $request->session()->forget('test'); // удалить запись
        $request->session()->flush(); // очистить всю сессию
        /* Flash переменные нужны для сохранения данных для следующего запроса, например, сообщение */
        $request->session()->flash('success', 'Данные сохранены');
        dump(session()->all());
    }
}
