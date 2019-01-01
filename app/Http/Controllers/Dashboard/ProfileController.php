<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use Request;

class ProfileController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();

        return view('dashboard/profile/index', ['first_name' => $user->first_name, 'last_name' => $user->last_name, 'company_name' => $user->company_name, 'country_type' => $user->country_type]);
    }

    public function ChangeUserProfile()
    {
        $user = Auth::user();
        $first_name = Request::input('first-name');
        $last_name = Request::input('last-name');
        $company_name = Request::input('company-name');
        $coutry_type = Request::input('country-type');

        $user_id = $user->id;
        $obj_user = User::find($user_id);
        $obj_user->first_name = $first_name;
        $obj_user->last_name = $last_name;
        $obj_user->company_name = $company_name;
        $obj_user->country_type = $coutry_type;
        $obj_user->save();

        return redirect('dashboard/profile');
    }
}
