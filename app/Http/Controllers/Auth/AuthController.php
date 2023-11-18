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

        return redirect()->route('login')->with('error', 'Incorrect email or password. Please sign in again!');
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
                $message = 'User name already exists!';
            if ($checkEmail)
                $message = 'Email already exists!';
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

            return redirect()->route('login')
                ->with('success', 'You have successfully registered. Please verify your Email first!');
        } catch (Exception $e) {
            return redirect()->route('register')->with('error', 'Unable to register due to system error!');
        }
    }

    public function verifyEmail(string $token)
    {
        $user = User::where('token_verify_email', $token)->first();
        if (!$user)
            return redirect()->route('login')->with('error', 'User does not exist');

        if ($user->status === User::STATUS_INACTIVE) {
            $user->update([
                'email_verified_at' => now(),
                'status' => User::STATUS_ACTIVE
            ]);

            return redirect()->route('login')->with('success', 'Email has been verified and you can sign in');
        }
        return redirect()->route('login')->with('error', 'Your email has been previously authenticated');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('homepage');
    }
}
