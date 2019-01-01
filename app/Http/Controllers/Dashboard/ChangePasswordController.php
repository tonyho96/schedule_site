<?php

namespace App\Http\Controllers\Dashboard;


use App\Http\Controllers\Controller;
use Auth;
use Request;
use Hash;
use App\Models\User;
use Session;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('dashboard/change-password/index');
    }

    public function ChangeUserPassword()
    {
        $user = Auth::user();

        $cur_password = Request::input('current-password');
        $new_password = Request::input('new-password');
        $confirm_new_password = Request::input('confirm-new-password');
        if ($new_password === $confirm_new_password) {
            if (Hash::check($cur_password, $user->password)) {
                $user_id = $user->id;
                $obj_user = User::find($user_id);
                $obj_user->password = Hash::make($new_password);
                $obj_user->save();
                //return response()->json(["result"=>true]);
                Session::flash('message', 'Password changed successfully!');
                Session::flash('alert-class', 'alert-success');

                return redirect('dashboard/change-password');
            } else {
                //return response()->json(["result"=>false]);
                Session::flash('message', 'Current password is incorrect!');
                Session::flash('alert-class', 'alert-danger');

                return redirect('dashboard/change-password');
            }
        }
    }
}