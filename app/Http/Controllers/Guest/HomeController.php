<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function viewHome (){
        $blogs = Post::with('user')->get();
        $categories = Category::get('name');

        return view('index')->with([
            'blogs' => $blogs,
            'categories'=> $categories
        ]);
    }
}
