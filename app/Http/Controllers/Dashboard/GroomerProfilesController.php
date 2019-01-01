<?php

namespace App\Http\Controllers\Dashboard;

use Auth;
use App\Models\Groomer;
use App\Models\customer;
use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class GroomerProfilesController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mobile_phone' => 'numeric|max:255',
            'home_phone' => 'numeric|max:255',
            'work_phone' => 'numeric|max:255',
            'email' => 'string|email|max:255',
            'address' => 'string',
        ]);
    }

    public function showSearchForm()
    {
        $user_id = Auth::user()->id;
        $groomers = Groomer::where('user_id', $user_id)->get();

        return view('dashboard/groomer-profiles/search', ['groomers' => $groomers]);
    }

    public function showAddForm()
    {
        return view('dashboard/groomer-profiles/create');
    }

    public function showGroomerDetailForm($id)
    {
        $groomer = Groomer::find($id);

        return view('dashboard/groomer-profiles/detail',
            [
                'groomer' => $groomer,
            ]
        );
    }

    public function saveGroomer(Request $request)
    {
        $data = $request->all();

        $user_id = Auth::user()->id;

        $result = Groomer::create([
            'user_id' => $user_id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile_phone' => $data['mobile_phone'],
            'work_phone' => $data['work_phone'],
            'home_phone' => $data['home_phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'address2' => $data['address2'],
            'town' => $data['town'],
            'country_state' => $data['country_state'],
            'post_zip_code' => $data['post_zip_code'],
            'note' => $data['notes'],

        ]);

        return redirect('dashboard/groomers/detail/' . $result['id']);
    }

    public function editGroomer(Request $request)
    {
        $data = $request->all();
        Groomer::where('id', $data['groomer_id'])->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile_phone' => $data['mobile_phone'],
            'work_phone' => $data['work_phone'],
            'home_phone' => $data['home_phone'],
            'email' => $data['email'],
            'address' => $data['address'],
            'address2' => $data['address2'],
            'town' => $data['town'],
            'country_state' => $data['country_state'],
            'post_zip_code' => $data['post_zip_code'],
            'note' => $data['notes'],
        ]);

        return redirect('dashboard/groomers/detail/' . $data['groomer_id']);
    }

    public function deleteGroomer($id)
    {

        return Groomer::destroy($id);
        // return redirect('dashboard/Groomers/search/');
    }
}
