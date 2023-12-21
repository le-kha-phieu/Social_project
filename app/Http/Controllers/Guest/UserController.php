<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditProfileRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function user()
    {
        $user = User::get();
        return view('index');
    }

    public function getBlog()
    {
        return Post::where('user_id', Auth::id())
            ->with('user')
            ->orderBy('created_at', 'desc');
    }

    public function myBlog()
    {
        return view('user.my_blog', [
            'blogs' => $this->getBlog()->paginate(Post::LIMIT_BLOG_PAGE),
            'categories' => Category::get(),
        ]);
    }

    public function editProfile()
    {
        return view('user.profile', [
            'profile' => Auth::user(),
            'blogs' => $this->getBlog()->paginate(Post::LIMIT_BLOG_PROFILE),
        ]);
    }

    public function updateProfile(EditProfileRequest $request)
    {
        try {
            if (isset($request['avatar'])) {
                $fileAvatar = Storage::disk('public')->put('images', $request->file('avatar'));
            } else {
                $fileAvatar = auth()->user()->avatar;
            }

            auth()->user()->update([
                'user_name' => $request['user_name'],
                'avatar' => $fileAvatar,
            ]);

            $message = 'success';
        } catch (Exception $e) {

            $message = 'error';
        }
        return redirect()->route('profile.user')->with('message', $message);
    }

}
