<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use App\Services\BreedService;
use Auth;
use Illuminate\Http\Request;

class PetBreedController extends Controller
{
    public function index()
    {
        return view('dashboard/pet-breeds/index');
    }

    public function ajaxSearchByKey(Request $request)
    {
        $key = $request->get('key');

        switch ($key) {
            case '':
                $breeds = [];
                break;
            case 'all':
                $breeds = Breed::all();
                break;
            case '0_9':
                $breeds = Breed::whereRaw("name REGEXP '^[0-9]'")->get();
                break;
            default:
                $lower = strtolower($key);
                $upper = strtoupper($key);
                $breeds = Breed::where('name', 'like', "$lower%")->orWhere('name', 'like', "$upper%")->get();
        }

        return view('dashboard.pet-breeds.ajax-search-by-key', compact('breeds'));
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        $validateResult = BreedService::validate($inputs);
        if ($validateResult->fails()) {
            return redirect()->action('Dashboard\PetBreedController@index')
                ->withErrors($validateResult);
        }

        if (BreedService::create($inputs)) {
            return redirect()->action('Dashboard\PetBreedController@index')
                ->with('message', 'New breed has successfully created');
        }

        return redirect()->action('Dashboard\PetBreedController@index')
            ->withErrors('Fail to create new breed');
    }

    public function ajaxUpdate($id, Request $request)
    {
        $breed = Breed::find($id);

        if (!$breed) {
            return json_encode([
                'status' => 0,
                'message' => 'Breed not found'
            ]);
        }

        $inputs = $request->all();
        $validateResult = BreedService::validate($inputs);
        if ($validateResult->fails()) {
            return json_encode([
                'status' => 0,
                'message' => 'Invalid data'
            ]);
        }

        if (BreedService::update($breed, $inputs)) {
            return json_encode([
                'status' => 1
            ]);
        }

        return json_encode([
            'status' => 0,
            'message' => 'Fail to update breed'
        ]);
    }


    public static function ajaxDelete($id)
    {
        if (BreedService::delete($id)) {
            return json_encode([
                'status' => 1
            ]);
        } else {
            return json_encode([
                'status' => 0,
                'message' => 'Fail to delete breed'
            ]);
        }
    }
}