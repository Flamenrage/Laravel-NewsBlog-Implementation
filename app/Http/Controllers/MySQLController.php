<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;

class MySQLController extends Controller
{
    public function index()
    {
        //select('поле') - выбираем только нужные поля из БД, например популяцию и площадь
        //limit(n) - количество записей
        //get() - select в mysql
        //first() - первая попавшаяся запись в БД
        //  $data = DB::table('country')->select('Code', 'Name')->first(); - одномерный массив
        //orderBy(поле по которому сортируем, дефолт='asc' или 'desc')
        //$data = DB::table('country')->select('Code', 'Name')->limit(5)->get();
        //почему-то функции кроме get() отказываются работать в контроллере, поэтому при возвращении даты
        // нужно трансформировать объект в json или массив json_encode($other_data);
        // find(id) - ищет запись по id
        // where(условие) - позволяет указывать условие для поиска, 1 аргумент - колонка, 2 - оператор (>, = и тд), 3 - значение
        //либо: where('id, 2')->get() = одна запись с нужным id
        //либо: where('id', '>=', 2), вернет записи с нужными id
        $data = DB::table('country')->select('Code', 'Name')->orderBy('Code', 'desc')->get();
        $other_data = $data->first(); // первый элемент
        $posts =  DB::select("SElECT * FROM country");
        //dd($other_data);
        $find_data = DB::table('city')->find(1);
        $where_data = DB::table('city')->where('ID', '>', '10')->get();
        $where_many_data = DB::table('city')->where([
            ['ID', '>', '10'], ['CountryCode', '=', 'NLD']
        ])->get();
        $string_data = DB::table('city')->where('ID', '>', '10')->value('Name'); // только поле в виде строки, первая попавшаяся запись
        // dd($find_data);
        // dd($where_data);
        //dd($string_data);
        // _______________
        //pluck - возвращает значения столбца в таблице
        $pluck_data = DB::table('country')->limit(10)->pluck('Name'); //первые 10 стран из списка
        //чтобы нумерация шла не с нуля, а ключом было какое-то выбранное поле - прописываем вторым аргументом
        $pluck_data1 = DB::table('country')->limit(10)->pluck('Name', 'Code'); //Code => Country, OtherCode => OtherCountry и тд
        //count() - подсчитывает количество записей, max('Population'), min('Population') - для БД тоже
        //sum() - сумма элементов, avg() - среднее арифметическое элементов
        //нашли страну с минимальным количеством жителей, то популяцией больше 10000
        $max_data =   DB::table('country')->select('Name', 'Population')->where('Population', '>', '10000')->orderBy('Population', 'asc')->first();
        //distinct() - отбарсывает повторяющиеся результаты в таблице при получении ответа на запрос
        $uniq_data = DB::table('city')->select('CountryCode')->distinct()->get();
        // объединение таблиц
        $city_group_data = DB::table('city')->select('city.ID', 'city.Name as CityName', 'country.Code', 'country.Name as CountryName')
            ->limit(10)->join('country', 'city.CountryCode', '=', 'country.Code' )
            ->orderBy('city.ID')->get();
        return json_encode($city_group_data);
        // return "TYPE: ".gettype($data);
    }
}
