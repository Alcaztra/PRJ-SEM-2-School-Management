<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        // $user = Auth::guard('admin')->user();
        return view('pages.profile.profile');
    }

    public function showFormPassword(Request $requset)
    {
        return view('pages.profile.update.password');
    }

    public function updatePassword(Request $request)
    {
        $validate_result = $request->validate([
            // validate rule
        ]);
        $password = Hash::make($request->input('new_password'));
        $user_id = Auth::guard('admin')->user()->user_id;
        $result = DB::table('admins')->limit(1)->where('user_id', $user_id)->update(['password' => $password]);
        if ($result) {
            Auth::guard('admin')->logout();
            return redirect()->intended(route('dashboard'));
        } else {
            print("<script>alert('Update fail..!!')</script>");
            return redirect()->back();
        }
    }

    public function updateAvatar(Request $request)
    {
        $validate_result = $request->validate([
            'files' => ['preview_image' => 'requried|image|size:4000']
        ]);
        // dd($validate_result);
        $file = $request->file('preview_image');
        if ($request->hasFile('preview_image')) {
            $file_name = $file->getClientOriginalName();
            $path = $file->storeAs('public/uploads/avatar/', $file_name);
            $user = Admin::where('user_id', Auth::guard('admin')->user()->user_id)->first();
            $user->avatar = $file_name;
            $user->save();
            Auth::guard('admin')->user()->avatar = $file_name;
            print("<script>alert('File has been uploaded.!')</script>");
        }
        return redirect()->back();
    }
}