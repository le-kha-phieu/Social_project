<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/scss/app.scss'])
    @vite(['resources/js/homepage.js'])
</head>

<body>
    <header id="header">
        <div class="header-form">
            <div class="header-navbar">
                <div class="header-left">
                    <a href="{{ route('homepage') }}">
                        <img src="{{ Vite::asset('/resources/image/Logo.png') }}" alt="">
                    </a>
                    <div class="search-header">
                        @if (Route::is('homepage'))
                            <form action="{{ route('search.blog') }}" method="GET">
                        @else
                            <form action="{{ route('search.myBlog') }}" method="GET">
                        @endif
                        <input type="text" name="data" value="{{ request('data') }}"
                            placeholder="Search blog... ">
                        <button>
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                        </form>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-tag">
                        <a href="{{ route('homepage') }}">Top</a>
                    </div>
                    <div class="header-account-login">
                        @if (!Auth::user())
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Sign up</a>
                        @else
                            <a href="{{ route('create.blog') }}">Create Blog</a>
                            <a href="">{{ Auth::user()->user_name }}</a>
                            <div class="avatar">
                                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="">
                                <div class="connect-menu"></div>
                                <ul>
                                    <li>
                                        <a href="{{ route('profile.user') }}">Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('myBlog') }}">My blogs</a>
                                    </li>
                                    <li>
                                        <a href="">Change password</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}">Logout</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div id="notifyBlog">
        @if (session('message') === 'successcreateblog')
            <div class="notify-create-blog-success">
                <div class="notify-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="notify-body">
                    <h3>Success</h3>
                    <p>You have successfully created your blog, please wait for approval.</p>
                </div>
                <div class="notify-close">
                    <i class="fa-solid fa-xmark" id="closeButton"></i>
                </div>
            </div>
        @elseif(session('message') === 'errorcreateblog')
            <div class="notify-create-blog-error">
                <div class="notify-icon">
                    <i class="fa-solid fa-circle-exclamation"></i>
                </div>
                <div class="notify-body">
                    <h3>Error</h3>
                    <p>Your blog could not be created due to a system error. Please try again later!</p>
                </div>
                <div class="notify-close">
                    <i class="fa-solid fa-xmark" id="closeButton"></i>
                </div>
            </div>
        @endif
        @if (session('message') === 'successdelete')
            <div class="notify-delete-blog-success">
                <div class="notify-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="notify-body">
                    <h3>Success</h3>
                    <p>Your blog has been successfully deleted.</p>
                </div>
                <div class="notify-close">
                    <i class="fa-solid fa-xmark" id="closeButton"></i>
                </div>
            </div>
        @elseif(session('message') === 'errordelete')
            <div class="notify-delete-blog-error">
                <div class="notify-icon">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <div class="notify-body">
                    <h3>Error</h3>
                    <p>Your blog could not be deleted due to a system error.</p>
                </div>
                <div class="notify-close">
                    <i class="fa-solid fa-xmark" id="closeButton"></i>
                </div>
            </div>
        @endif
    </div>
    @yield('body')
    <footer>
        <div class="footer-form">
            <span>Copyright 2023. Made by P&C</span>
        </div>
    </footer>
</body>

</html>
