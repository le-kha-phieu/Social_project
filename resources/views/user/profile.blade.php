@vite(['resources/js/profile.js'])
@extends('layouts.app')

@section('body')
    <div class="profile-form">
        <form method="POST" action="{{ route('updateProfile.user', ['user' => $profile]) }}" enctype="multipart/form-data"
            class="user-info">
            @csrf
            @method('PUT')
            <img class="avatar avatar-profile" src="{{ Storage::url($profile->avatar) }}"alt="">
            <label class="btn-upload-avatar">Choose Avatar
                <input type="file" id="avatarInput" class="upload-avatar-user" name="avatar">
            </label>
            <div class="user-name">
                <h3>Username: </h3>
                <p class="user-name-text">{{ $profile->user_name }}</p>
                <input type="text" class="input-user-name" name="user_name" value="{{ $profile->user_name }}">
                @error('user_name')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="user-email">
                <h3>Email: </h3>
                <p>{{ $profile->email }}</p>
            </div>
            <div class="user-info-edit btn-edit">Edit Profile</div>
            <button class="user-info-edit btn-save">Save</button>
        </form>
        <div class="blogs-user">
            @foreach ($blogs as $blog)
                <h3 class="header-blogs-user"> My blogs</h3>
                <a href="{{ route('detail', ['blog' => $blog]) }}" alt="">
                    <div class="blogs-user-main">
                        <img class="image" src="{{ Storage::url($blog->image) }}" alt="">
                        <h2 class="title">{{ $blog['title'] }}</h2>
                        <p class="content">{!! nl2br(e(Str::limit($blog->content, 80))) !!}</p>
                    </div>
                </a>
            @endforeach
            @include('layouts.components.pagination')
        </div>
    </div>
    @if (session('message') === 'success')
        <div class="notify-edit-profile-success">
            <div class="notify-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="notify-body">
                <h3>Success</h3>
                <p>You have successfully updated your profile.</p>
            </div>
        </div>
    @elseif(session('message') === 'error')
        <div class="notify-edit-profile-error">
            <div class="notify-icon">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="notify-body">
                <h3>Error</h3>
                <p>You have failed to update your profile.</p>
            </div>
        </div>
    @endif
@endsection
