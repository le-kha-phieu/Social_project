<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;

class HomeController extends Controller
{
    public function viewHome()
    {
        $blogs = Post::with('user')
            ->where('status', Post::STATUS_APPROVED)
            ->orderBy('created_at', 'desc') 
            ->paginate(6);

        return view('index')->with([
            'blogs' => $blogs,
            'categories' => Category::get(),
        ]);
    }
}
