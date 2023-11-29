<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Category;
use App\Http\Requests\BlogRequest;
use App\Models\Post;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function viewCreate()
    {
        return view('user.create_blog')->with([
            'categories' => Category::get()
        ]);
    }

    public function store(BlogRequest $request)
    {
        try {
            $imageBlog = Storage::disk('public')->put('images', $request->file('image'));

            Post::create([
                'user_id' => Auth::user()->id,
                'category_id' => $request['category_id'],
                'title' => $request['title'],
                'image' => $imageBlog,
                'content' => $request['content'],
            ]);

            $message = 'successcreateblog';
        } catch (Exception $e) {
            $message = 'errorcreateblog';
        }

        return redirect()->route('homepage')->with('message', $message);
    }

    public function detail(Post $blog)
    {
        $relatedBlogs = $this->relatedBlog($blog->category_id, $blog->id);

        return view('detail_blog', [
            'blog' => $blog,
            'relatedBlogs' => $relatedBlogs
        ]);
    }

    public function relatedBlog(int $categoryId, int $blogId): Collection
    {
        return Post::where([
            ['status', Post::STATUS_APPROVED],
            ['category_id', $categoryId],
            ['id', '!=', $blogId]
        ])
            ->inRandomOrder()
            ->take(Post::MAX_RELATED_POSTS)
            ->get();
    }

    public function edit(Post $blog)
    {
        return view('user.update_blog', [
            'blog' => $blog,
            'categories' => Category::get(),
            'categorySelected' => $blog->category_id,
        ]);
    }

    public function update(UpdateBlogRequest $request, Post $blog)
    {

        try {
            if (isset($request['image'])) {
                $fileImage = Storage::disk('public')->put('images', $request->file('image'));
            } else {
                $fileImage = $blog->image;
            }

            $blog->update([
                'category_id' => $request['category_id'],
                'title' => $request['title'],
                'content' => $request['content'],
                'image' => $fileImage,
            ]);

            $message = 'success';
        } catch (Exception $e) {
            $message = 'error';
        }
        return redirect()->route('detail', ['blog' => $blog])->with('message', $message);
    }


    public function delete(Post $blog)
    {
        try {
            DB::beginTransaction();

            $blog->likes()->detach();
            $blog->comments()->detach();
            $blog->delete();

            DB::commit();

            $message = 'successdelete';
        } catch (Exception $e) {
            DB::rollBack();
            $message = 'errordelete';
        }

        return redirect()->route('homepage')->with('message', $message);
    }

    public function searchBlog(Request $request)
    {
        $dataSearch = [
            'data' => $request->input('data'),
            'categoryId' => $request->input('id'),
        ];

        $query = Post::query();

        if ($dataSearch['data'] !== '') {
            $query->where(function ($query) use ($dataSearch) {
                $query->where('title', 'like', '%' . $dataSearch['data'] . '%')
                    ->orWhere('content', 'like', '%' . $dataSearch['data'] . '%');
            });
        }

        if ($dataSearch['categoryId']) {
            $query->where('category_id', $dataSearch['categoryId']);
        }

        $blogs = $query->orderBy('created_at', 'desc')
            ->paginate(Post::LIMIT_BLOG_PAGE)
            ->withQueryString($dataSearch);

        return view('index', [
            'blogs' => $blogs,
            'categories' => Category::get(),
        ]);
    }

    public function searchMyBlog(Request $request)
    {
        $dataSearch = [
            'data' => $request['data'],
            'categoryId' => $request['id'],
        ];

        $query = Post::where('user_id', Auth::id());

        if ($dataSearch['data']) {
            $query->where(function ($query) use ($dataSearch) {
                $query->where('title', 'like', '%' . $dataSearch['data'] . '%')
                    ->orWhere('content', 'like', '%' . $dataSearch['data'] . '%');
            });
        }

        if ($dataSearch['categoryId']) {
            $query->where(['category_id' => $dataSearch['categoryId']]);
        }

        $myBlog = $query->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(Post::LIMIT_BLOG_PAGE);

        return view('user.my_blog', [
            'request' => $request,
            'blogs' => $myBlog,
            'categories' => Category::get(),
        ]);
    }
}

