<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $messages = [
            'name.cyrillic' => 'Имя должно содержать только буквы алфавита',
        ];
        $rules = [
            'name' => 'cyrillic|required|max:150|min:3',
            'email' => 'required|email|unique:users', //проверка на уникальность в таблице БД
            'password' => 'required|max:25|min:5|confirmed', //сранивается с confirm_password
            'avatar' => 'nullable|image'
        ];
        $this->validate($request, $rules, $messages); //или $request->validate([ 'массив валидационных правил' ]);
        //dd($request->all());
        if ($request->hasFile('avatar')) {
            $folder = date('Y-m-d'); //2021-06-20 и тд
            $path = $request->file('avatar')->store("images/${folder}"); //сохранит картинку в папку app/public/images/папка с именем под случайным именем
        }
        $user = User::create([
            'name' => $request->name, //или $request->input('name');
            'email' => $request->email,
            'password' => Hash::make($request->password), //хэшируем пароль
            'avatar' => $path ?? null
        ]);
        //После регистрации авторизуем пользователя в системе
        //Работаем с фасадом Auth либо через helper auth
        //https://laravel.com/docs/7.x/authentication#other-authentication-methods
        //https://laravel.com/docs/7.x/helpers#method-auth

        session()->flash('success', 'Success registration');
        Auth::login($user);
        return redirect()->home();
    }

    public function login(Request $request)
    {

        $rules = [
            'email' => 'required|email', //проверка на уникальность в таблице БД
            'password' => 'required',
        ];
        $this->validate($request, $rules); //или $request->validate([ 'массив валидационных правил' ]);
        //dd($request->all());
        if(Auth::attempt([
            'email' => $request->email,  //или $request->input('name');
            'password' => $request->password
        ])) {
            return redirect()->home();
        }
        return redirect()->back()->with('error', 'Логин или пароль неправильные'); //возвращаемся назад
        //выводим flash сообщение, что дата неверная
    }

    public function loginForm()
    {

        return view('user.login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.create');
    }
}
