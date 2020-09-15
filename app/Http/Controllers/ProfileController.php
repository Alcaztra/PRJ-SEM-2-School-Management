<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        // $user = Auth::guard('admin')->user();
        return view('pages.profile.profile');
    }

    public function showFormProfile()
    {
        $user = Auth::guard('admin')->user();
        return view('pages.profile.update.profile')->with('user_profile', $user);
    }

    public function showFormPassword()
    {
        return view('pages.profile.update.password');
    }

    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|regex:/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[\s\d]*$/|max:14',
            'birthday' => 'required|date|before:-16 years',
            'address' => 'required',
        ]);
        $user = Admin::where('user_id', $request->user_id)->first();
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->address = $request->address;
        // dd($user);
        $result = $user->save();
        // dump($result);
        // return view('pages.profile.profile')->with('notify_update', $notify_update);
        return redirect(route('profile'))->with('result', $result);
    }

    public function updatePassword(Request $request)
    {
        $validate_result = $request->validate([
            // validate rule
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    $old = Auth::guard('admin')->user()->password;
                    if (!Hash::check($value, $old)) {
                        $fail($attribute . ' is incorrect.');
                    }
                },
            ],
            'new_password' => [
                'required',
                'min:6',
                'max:50',
                'different:old_password'
            ],
            'confirm_password' => ['same:new_password'],
        ]);
        $password = Hash::make($request->input('new_password'));
        $user_id = Auth::guard('admin')->user()->user_id;
        $result = DB::table('admins')->limit(1)->where('user_id', $user_id)->update(['password' => $password]);
        if ($result) {
            return redirect()->back();
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
