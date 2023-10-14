@extends('layouts.app')
@section('body')
    <div class="list-blog">
        <div class="title">
            <h1>List Blog</h1>
            <select name="category_id">
                <option value="Category">Category</option>
                <option value="Sport">Sport</option>
                <option value="Romantic">Romantic love romantic</option>
                <option value="Music">Music</option>
            </select>
        </div>
        <div class='all-item'>
            <div class='item-blog'>
                <div class='item-blog-img'>
                    <img src="{{Vite::asset('/resources/image/img_header_home_page.jpg')}}" alt=''>
                </div>
                <div class='item-blog-content'>
                    <div class='info'>
                        <div class='author'>
                            <img src='../../../assets/img/' alt=''>
                            <p>user_name</p>
                        </div>
                        <div class='time'>
                            <img src='../../../assets/img/watch.jpg' alt=''>
                            <p>created_at</p>
                        </div>
                    </div>
                    <div class='text-detail'>
                        <p>Story</p>
                        <p>content</p>
                    </div>
                    <div class='text-link'>
                        <button>
                            <a href=''>Read more</a>
                            <i class='fa-solid fa-arrow-right'></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
