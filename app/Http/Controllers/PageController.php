<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function show()
    {
        return view("pages.about");
    }
    /*public function show($slug)
    {
        return view("pages.$slug", ['slug' => $slug]);
    }*/
}
