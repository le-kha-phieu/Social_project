@vite(['resources/scss/app.scss'])
<style>
    .avatar {
        margin-left: 17px;

        img {
            width: 27px;
            height: 27px;
            border-radius: 50%;
        }

        .connect-menu {
            border: 15px solid;
            border-color: transparent transparent var(--main-white) transparent;
            position: absolute;
            top: 50%;
            right: 101px;
            display: none;
        }

        ul {
            min-width: 90px;
            position: absolute;
            top: 62%;
            right: 100px;
            z-index: 3;
            margin-top: 12px;
            background-color: var(--main-white);
            border-radius: 5px;
            overflow: hidden;
            display: none;

            li {
                width: 100%;
                text-align: center;
                margin: 5px 0;
                padding: 0 10px;

            }
        }

    }
</style>
@if (Auth::user())
    <p>{{ Auth::user()->user_name }}</p>
    <div class="avatar">
        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="">
        <div class="connect-menu"></div>
    </div>
    <a href="{{ route('logout') }}">Logout here</a>
@else
    <a href="{{ route('login') }}">Login here</a>
    <a href="{{ route('register') }}">Register here</a>
@endif
