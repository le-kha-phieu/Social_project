@vite(['resources/js/detail_blog.js'])
@extends('layouts.app')

@section('body')
    <div class='layout-detail'>
        <div class='dashboard'>
            <a href='{{ route('homepage') }}'>Home</a>
            <i class="fa-solid fa-chevron-right"></i>
            <h4>Detail blog</h4>
        </div>
        <div class='layout-detail-content'>
            <div class='author'>
                <img src="{{ Storage::url($blog->user->avatar) }}" alt="">
                <div class='info'>
                    <p class='user-name'>{{ $blog->user->user_name }}</p>
                    <p>{{ $blog->created_at->format('d/m/Y') }}</p>
                </div>
            </div>
            @if (Auth::check())
                <div class='control'>
                    @if (Auth::id() == $blog->user_id)
                        @if ($blog->status == \App\Models\Post::STATUS_UNAPPROVED)
                            <a class='not-approved' href='#'>Not aproved</a>
                        @else
                            <a class='approved' href='#'>Approved</a>
                        @endif
                        <a class='update' href='{{ route('edit', ['blog' => $blog]) }}'>Update Blog</a>
                        <a class='delete' id="btnDelete" href='#'>Delete
                            Blog</a>
                    @endif
                </div>
            @endif
        </div>
        <div class='detail-content'>
            <h2 class='title'>{{ $blog->title }}</h2>
            <div class='content'>
                <p>{!! nl2br(e($blog->content)) !!}</p>
            </div>
            <img class='image-blog' src="{{ Storage::url($blog->image) }}" alt="">
            <div class='info-interactive'>
                <i class="fa-solid fa-heart">
                    <p>1</p>
                </i>
                <i class="fa-solid fa-comment">
                    <p>1</p>
                </i>
            </div>
        </div>
        <div class='detail-comment-title'>
            <h2>Comment</h2>
        </div>
        <div class='detail-comment-content'>
            @if (Auth::check())
                <img class='avatar' src="{{ Storage::url(Auth::user()->avatar) }}" alt="">
                <textarea name='content' rows='4' cols='155' placeholder='Input your comment'></textarea>
                <button>Send</button>
            @endif
        </div>
        <div class='related-title'>
            <h2>Related blogs</h2>
        </div>
        <div class='related-content'>
            @foreach ($relatedBlogs as $relatedBlog)
                <div class='related-form-blog'>
                    <a href="{{ route('detail', ['blog' => $relatedBlog]) }}">
                        <img src="{{ Storage::url($relatedBlog->image) }}" alt="">
                        <p>{!! nl2br(e(Str::limit($relatedBlog->title, 65))) !!}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="form-delete" id="formBox">
        <div class="box-delete">
            <i class="fa-solid fa-circle-xmark" id="closeBox"></i>
            <p class="question-delete">Are you sure you want to delete this blog?</p>
            <form class="btn-delete" action="{{ route('delete.blog', ['blog' => $blog]) }}" method="POST">
                @method('DELETE')
                @csrf
                <div class="unaccept-delete" id="cancelBox">Cancel</div>
                <button class="accept-delete">Delete</button>
            </form>
        </div>
    </div>
    @if (session('message') === 'success')
        <div class="notify-update-blog-success">
            <div class="notify-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="notify-body">
                <h3>Success</h3>
                <p>Your blog has been updated successfully.</p>
            </div>
        </div>
    @elseif(session('message') === 'error')
        <div class="notify-update-blog-error">
            <div class="notify-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="notify-body">
                <h3>Error</h3>
                <p>Your blog cannot be updated due to a system error.</p>
            </div>
        </div>
    @endif
@endsection
