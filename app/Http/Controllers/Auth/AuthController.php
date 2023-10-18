<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\MailVerifyAccount;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $result = Auth::attempt([
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'status' => User::STATUS_ACTIVE,
        ]);
        if ($result) {
            return redirect()->route('homepage');
        }

        return redirect()->route('login')->with('error', 'Email hoặc password sai. Vui lòng đăng nhập lại!');
    }

    public function register(RegisterRequest $request)
    {
        try {
            $data = [
                'user_name' => $request['user_name'],
                'email' => $request['email'],
                'password' => $request['password'],
            ];

            $message = '';
            $checkUserName = User::where('user_name', $data['user_name'])->first();
            $checkEmail = User::where('email', $data['email'])->first();
            if ($checkUserName)
                $message = 'Name người dùng đã tồn tại!';
            if ($checkEmail)
                $message = 'Email người dùng đã tồn tại!';
            if ($message != '') {
                return redirect()->route('register')->with('error', $message);
            }

            $fileImage = Storage::disk('public')->put('images', $request->file('avatar'));
            $token = Str::random(64);
            User::create([
                'user_name' => $data['user_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'avatar' => $fileImage,
                'token_verify_email' => $token,
            ]);
            $dataSendMail = [
                'email' => $data['email'],
                'title' => 'Hi ' . $data['user_name'] . ' !',
                'token' => $token,
            ];
            MailVerifyAccount::dispatch($dataSendMail);

            return redirect()->route('login')->with('success', 'Bạn đã đăng ký thành công. Vui xác thực Email trước!');
        } catch (Exception $e) {
            return redirect()->route('register')->with('error', 'Không thể đăng ký do lỗi hệ thống!');
        }
    }

    public function verifyEmail(string $token)
    {
        $user = User::where('token_verify_email', $token)->first();
        if (!$user)
            return redirect()->route('login')->with('error', 'Người dùng không tồn tại');

        if ($user->status === User::STATUS_INACTIVE) {
            $user->update([
                'email_verified_at' => now(),
                'status' => User::STATUS_ACTIVE
            ]);

            return redirect()->route('login')->with('success', 'Email đã xác thực bạn có thể đăng nhập');
        }
        return redirect()->route('login')->with('error', 'Email bạn đã được xác thực trước đó');
    }

    public function logout()
    {
        Auth::logout();
        return view('layouts.app');
    }
}
