@extends('layouts.authentication.base')
@section('content')
    <div class="app-auth">
        <div class="box-form">
            <div class="banner">
                <img src="{{Vite::asset('resources/image/Logo.png')}}" alt="">
                <h2>Welcome to <br> IT - HUMG Social</h2>
            </div>
            <form action="{{ route('post.register')}}" method="POST" enctype="multipart/form-data" class="register">
            @csrf
                <h3>Sign up</h3>
                <div class="item-form">
                    <p>Name:</p>
                    <input type="text" name="user_name" id="inputEmailReg" placeholder="Input your name">
                    @error('user_name')
                        <span class="notify-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="item-form">
                    <p>Email:</p>
                    <input type="email" name="email" id="inputEmailReg" placeholder="Input your email">
                    @error('email')
                        <span class="notify-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="item-form">
                    <p>Password:</p>
                    <input type="password" name="password" id="inputPasswordReg" placeholder="Input your password">
                    @error('password')
                        <span class="notify-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="item-form">
                    <p>Password confirm:</p>
                    <input type="password" name="password_confirmation" id="inputRePasswordReg" placeholder="Input your password confirm">
                    @error('password_confirmation')
                        <span class="notify-error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="item-form item-avatar">
                    <p>Avatar:</p>
                    <p id="chooseAvatarButton" class="choose-avatar">Choose avatar</p>
                    <input type="file" name="avatar" id="inputReAvartar">
                </div>
                    @error('avatar')
                        <span class="notify-error">{{ $message }}</span>
                    @enderror
                    @if (session('error'))
                        <span class='notify-error'>{{ session('error') }}</span>
                    @endif
                <div class="btn-form item-form">
                    <button type="submit" name="submit_register" id="btnRegister">Sign up</button>
                </div>
                <div class="item-form text-link">
                    <a href="{{route('login')}}">Already have an account? Login here</a>
                </div>
            </form>
        </div>
    </div>
@endsection
