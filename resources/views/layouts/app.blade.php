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
            <img src="{{ Vite::asset('/resources/image/img_header_home_page.jpg') }}" alt="">
            <div class="header-navbar">
                <div class="header-left">
                    <img src="{{ Vite::asset('/resources/image/Logo.png') }}" alt="">
                    <div class="search-header">
                        <input type="text" placeholder="Search blog... ">
                        <button>
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-tag">
                        <a href="">Top</a>
                    </div>
                    <div class="header-account-login">
                        @if (!Auth::user())
                            <a href="{{ route('login') }}">Login</a>
                            <a href="{{ route('register') }}">Sign up</a>
                        @else
                            <a href="">Create Blog</a>
                            <a href="">{{ Auth::user()->user_name }}</a>
                            <div class="avatar">
                                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="">
                                <div class="connect-menu"></div>
                                <ul>
                                    <li>
                                        <a href="">Profile</a>
                                    </li>
                                    <li>
                                        <a href="">My blogs</a>
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
    @yield('body')
    <footer>
        <div class="footer-form">
            <span>Copyright 2023. Made by P&C</span>
        </div>
    </footer>
</body>

</html>
