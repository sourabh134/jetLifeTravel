<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.auth-cover-signin');
    }

    public function adminLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        $admin = Admin::where('username', $credentials['username'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            // Set session
            $request->session()->put([
                'adminUser' => $admin->username,
                'jet_admin_user_id' => $admin->id,
                'jet_admin_user_type' => $admin->userType,
                'name' => $admin->name,
                'email' => $admin->email,
                'profile_img' => $admin->image,
            ]);

            Session::flash('message', 'You are logged in successfully.');
            return redirect('/dashboard');
        } else {
            Session::flash('message', 'Wrong username or password.');
            return redirect('/admin');
        }
    }

    public function adminDashboard()
    {
        $admin_id = Session::get('jet_admin_user_id');

        if (!$admin_id) {
            Session::flush();
            return redirect('/admin');
        }

        $admin = Admin::getAdminData($admin_id);
        return view('admin.index', compact('admin'));
    }

    function adminpassword()
    {
        $admin = Admin::find(1);
        $admin->password = Hash::make('Jet@123');
        $admin->save();
    }

    public function logout(){
        session::flush();
        return redirect('/admin');
    }
}
