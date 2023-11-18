@extends('layouts.app')
@section('body')
    <img src="{{ Vite::asset('/resources/image/img_header_home_page.jpg') }}" alt="">
    <div class="list-blog">
        <div class="title">
            <h1>List Blog</h1>
            <select name="category_id">
                <option value="">Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class='all-item'>
            @foreach ($blogs as $blog)
                <div class='item-blog'>
                    <div class='item-blog-img'>
                        <img src="{{ Storage::url($blog->image) }}" alt=''>
                    </div>
                    <div class='item-blog-content'>
                        <div class='info'>
                            <div class='author'>
                                <img src="{{ Storage::url($blog->user->avatar) }}" alt=''>
                                <p>{{ $blog->user->user_name }}</p>
                            </div>
                            <div class='time'>
                                <img src='{{ Vite::asset('resources/image/oclock.jpg') }}' alt=''>
                                <p>
                                    {{ $blog->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class='text-detail'>
                            <p>{{ $blog['title'] }}</p>
                            <p>{!! nl2br(e(Str::limit($blog->content, 100))) !!}</p>
                        </div>
                        <div class='text-link'>
                            <button>
                                <a href=''>Read more</a>
                                <i class='fa-solid fa-arrow-right'></i>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
