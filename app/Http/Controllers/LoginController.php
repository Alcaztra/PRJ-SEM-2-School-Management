<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if (session()->has('user') && session('user') !== null) {
            return redirect('/');
        }
        $this->store($request);

        $user_name = $request->input('user_name');
        $password = $request->input('password');

        $user = User::where('user_id', $user_name)->first();

        if ($user->password == $password) {
            session_start();
            session([
                'user' => $user->user_id,
                'role' => $user->user_role,
                'user-name' => $user->user_name,
                'user-image' => $user->user_image
            ]);

            User::where('user_id', $user_name)->update(['user_state' => 1]);

            return redirect('/');
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_name' => 'bail|required|min:6|alpha_num|exists:users,user_id',
            'password' => 'bail|required|alpha_num'
        ]);
    }
}
