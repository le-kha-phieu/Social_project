@extends('layouts.authentication.base')
@section('content')
    <div class="app-auth">
        <div class="box-form">
            <div class="banner">
                <img src="{{ Vite::asset('resources/image/Logo.png') }}" alt="">
                <h2>Welcome to <br> IT - HUMG Social</h2>
            </div>
            <form action="{{ route('post.login') }}" method="post">
                @csrf
                <h3>Sign in</h3>
                <div class="item-form">
                    <p>Email:<span>*</span></p>
                    <input type="email" name="email" id="inputEmail" placeholder="Input your email">
                    @error('email')
                        <span class="notify-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="item-form item-password">
                    <p>Password:<span>*</span></p>
                    <input type="password" name="password" id="inputPassword" placeholder="Input your password">
                    @error('password')
                        <span class="notify-error">{{ $message }}</span>
                    @enderror
                    @if (session('success'))
                        <span class='notify-success'>{{ session('success') }}</span>
                    @endif
                    @if (session('error'))
                        <span class='notify-error'>{{ session('error') }}</span>
                    @endif
                    <p class="text-forgot-password">Forgot your password?</p>
                </div>
                <div class="btn-form item-form">
                    <button type="submit" name="submit_login" id="btnLogin">Sign in</button>
                </div>
                <div class="item-form text-link">
                    <a href="{{ route('register') }}">Don't have an account? Sign up here</a>
                </div>
            </form>
        </div>
    </div>
@endsection
