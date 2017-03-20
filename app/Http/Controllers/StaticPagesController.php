<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Status;
use Auth;

class StaticPagesController extends Controller
{

    // 加载首页
    public function home()
    {
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(10);
        }

        return view('static_pages/home', compact('feed_items'));
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
