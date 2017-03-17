<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class StaticPagesController extends Controller
{

    // 加载首页
    public function home()
    {
        return view('static_pages/home');
    }

    // 加载帮助页
    public function help()
    {
      return view('static_pages/help');
    }

    // 加载关于页
    public function about()
    {
      return view('static_pages/about');
    }

}
