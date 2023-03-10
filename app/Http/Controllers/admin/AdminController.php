<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function ChangeEmail(Request $request)
    {
        $id = Auth::guard('admin')->user()->id;
        $admin = Admin::where('id', $id)->select('email')->first();
        return view("admin.auth.change_email", ['admin' => $admin]);
    } //


    public function ChangeEmailStore(Request $request)
    {

        $id = Auth::guard('admin')->user()->id;
        $admin = Admin::where('id', $id)->first();
        $admin->email = $request->email;
        $admin->save();
        if ($admin) {
            Session::flash('success', 'Admin Email Change Succesfully.');
        } else {
            Session::flash('error', 'Unable to add User.');
        }
        return redirect()->route('admin.changeemail');

        //
    }



    public function ChangePassword(Request $request)
    {
        Auth::guard('admin')->user();
        if ($request->isMethod('post')) {
            $id = Auth::guard('admin')->user()->id;
            $password = Hash::make($request->password);
            $admin = Admin::where('id', $id)->first();
            $admin->password = $password;
            $admin->save();
            if ($admin) {
                Session::flash('success', 'Admin Password Change Succesfully.');
            } else {
                Session::flash('error', 'Unable to add User.');
            }
            return view("admin.auth.change_password");
            //
        }
        return view("admin.auth.change_password");
    } //


    public function Logout()
    {

        Auth::guard('admin')->logout();
        Session::flash('success', 'Logout Succesfully.');

        return redirect('admin');
    }
}
