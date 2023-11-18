<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\BlogRequest;
use App\Models\Post;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function viewCreate()
    {
        $categories = Category::get();
        return view('user.create_blog')->with([
            'categories' => $categories
        ]);
    }

    public function store(BlogRequest $request)
    {
        try {
            $data = [
                'category_id' => $request['category_id'],
                'title' => $request['title'],
                'image' => $request['image'],
                'content' => $request['content']
            ];

            $imageBlog = Storage::disk('public')->put('images', $request->file('image'));
            Post::create([
                'user_id' => Auth::user()->id,
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'image' => $imageBlog,
                'content' => $data['content'],
            ]);

            $message = 'success';
        } catch (Exception $e) {
            $message = 'error';
        }
        
        return redirect()->route('homepage')->with('message', $message);
    }
}
