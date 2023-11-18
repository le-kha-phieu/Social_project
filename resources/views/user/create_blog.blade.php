@extends('layouts.app')

@section('body')
    <div class='layout_create'>
        <div class='dashboard'>
            <a href='{{ route('homepage') }}'>Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <h4>Create blog</h4>
        </div>
        <form action="{{ route('post.blog') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <h2>Create blog</h2>

            <label>Category <span>*</span></label>
            <select name="category_id">
                <option value="">Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="notify-error">{{ $message }}</span>
            @enderror

            <label>Title <span>*</span></label>
            <input name='title' type='text' placeholder='Input title your blog'>
            @error('title')
                <span class="notify-error">{{ $message }}</span>
            @enderror

            <label>Upload image <span>*</span></label>
            <p id="chooseImageButton">Upload image</p>
            <input type='file' name='image' id='inputImageBlog'>
            <div id="imagePreview"></div>
            @error('image')
                <span class="notify-error">{{ $message }}</span>
            @enderror

            <label>Description <span>*</span></label>
            <textarea name='content' rows='30' cols='70' placeholder='Decription'></textarea>
            @error('content')
                <span class="notify-error">{{ $message }}</span>
            @enderror
            
            <button>Create blog</button>
        </form>
    </div>
@endsection
