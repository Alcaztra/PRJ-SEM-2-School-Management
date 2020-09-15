<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected function guardName()
    {
        $host = request()->getHost();
        switch ($host) {
            case 'localhost':
                return 'admin';
            case 'student.localhost':
                return 'student';
            case 'teacher.localhost':
                return 'teacher';
        }
    }

    protected function user()
    {
        $host = request()->getHost();
        switch ($host) {
            case 'localhost':
                return Auth::guard('admin')->user();
            case 'student.localhost':
                return Auth::guard('student')->user();
            case 'teacher.localhost':
                return Auth::guard('teacher')->user();
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:' . $this->guardName());
    }

    public function index()
    {
        // $user = Auth::guard('admin')->user();
        return view('pages.profile.profile');
    }

    public function showFormProfile()
    {
        // $user = Auth::guard($this->guardName())->user();
        $user = $this->user();
        switch ($this->guardName()) {
            case 'student':
                $action = 'student.profile.update.profile.submit';
                break;
            case 'teacher':
                $action = 'teacher.profile.update.profile.submit';
                break;
            default:
                $action = 'profile.update.profile.submit';
                break;
        }

        return view('pages.profile.update.profile')->with(['user_profile' => $user, 'action' => $action]);
    }

    public function showFormPassword()
    {
        switch ($this->guardName()) {
            case 'student':
                $action = 'student.profile.update.password.submit';
                break;
            case 'teacher':
                $action = 'teacher.profile.update.password.submit';
                break;
            default:
                $action = 'profile.update.password.submit';
                break;
        }
        return view('pages.profile.update.password')->with(['action' => $action]);
    }

    public function updateProfile(Request $request)
    {
        $validate_result = $request->validate([
            // 
        ]);
        // $user = Admin::where('user_id', $request->user_id)->first();
        $user = $this->user();
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
        switch ($this->guardName()) {
            case 'student':
                return redirect(route('student.dashboard'))->with('result', $result);
                break;
            case 'teacher':
                return redirect(route('teacher.dashboard'))->with('result', $result);
                break;
            default:
                return redirect(route('profile'))->with('result', $result);
                break;
        }
    }

    public function updatePassword(Request $request)
    {
        // dd($this->guardName(), $request);
        $validate_result = $request->validate([
            // validate rule
        ]);
        $password = Hash::make($request->input('new_password'));
        // $user = Auth::guard($this->guardName())->user();
        $user = $this->user();
        // $result = DB::table('admins')->limit(1)->where('user_id', $user_id)->update(['password' => $password]);
        $user->password = $password;
        $result = $user->save();
        if ($result) {
            Auth::guard($this->guardName())->logout();
            // return redirect(route('dashboard'));
        } else {
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
            // $user = Admin::where('user_id', $request->user_id)->first();
            $user = $this->user();
            $user->avatar = $file_name;
            $user->save();
            Auth::guard($this->guardName())->user()->avatar = $file_name;
        }
        return redirect()->back();
    }
}
