<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AccountController extends Controller
{
    public function index()
    {
        $id = session()->get('user');
        $user = User::where('user_id', $id)->first();
        return view('pages.user-pages.account-info')->with('user', $user);
    }

    public function add()
    {
        return view('pages.user-pages.account-add');
    }

    public function update($user_id)
    {
        $user = User::where('user_id', $user_id)->first();
        return view('pages.user-pages.account-add', ['user' => $user]);
    }

    public function submit(Request $request)
    {
        if (!empty($user = User::where('user_id', $request->user_id)->first())) {

            $user->user_name = $request->user_name;
            $user->day_of_birth = $request->day_of_birth;
            $user->user_email = $request->user_email;
            $user->user_phone = $request->user_phone;
            $user->user_address = $request->user_address;

            error_log(print_r($user));

            // $user->save();
            User::where('user_id', $request->user_id)->update([
                'user_name' => $request->user_name,
                'day_of_birth' => $request->day_of_birth,
                'user_email' => $request->user_email,
                'user_phone' => $request->user_phone,
                'user_address' =>  $request->user_address
            ]);

            if (session('user') == $user->user_id) {
                session(['user-name' => $user->user_name]);
            }
        } else {
            $user = new User();
            $user->user_id = $request->user_id;
            $user->user_name = $request->user_name;
            $user->password = $request->password;
            $user->day_of_birth = $request->day_of_birth;
            $user->user_email = $request->user_email;
            $user->user_phone = $request->user_phone;
            $user->user_address = $request->user_address;
            $user->user_role = $request->user_role;
            $user->save();
        }


        return redirect('/');
    }

    public function changeImage($user_id, Request $request)
    {
        error_log($user_id);

        $file = $request->file('user_image_upload');
        $file_name = $file->getClientOriginalName();
        $path = 'images/profiles/';

        $file->storeAs('public/' . $path, $file_name);
        User::where('user_id', $user_id)->update(['user_image' => 'storage/' . $path . $file_name]);

        if (session('user') == $user_id) {
            session(['user-image' => 'storage/' . $path . $file_name]);
        }

        return redirect('/');
    }

    public function changePassword($user_id, Request $request)
    {
        if ($request->post() == null) {
            $user = User::where('user_id', $user_id)->first();
            return view('pages.user-pages.change-password')->with('user', $user);
        } else {
            $password = $request->input('new_password');
            User::where('user_id', $user_id)->update(['password' => $password]);

            return redirect('/');
        }
    }
}
