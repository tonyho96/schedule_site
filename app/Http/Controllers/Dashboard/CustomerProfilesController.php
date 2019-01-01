<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Breed;
use App\Models\Groomer;
use Auth;
use App\Models\Customer;
use App\Models\Pet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use DB;

class CustomerProfilesController extends Controller
{

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'mobile_phone' => 'numeric|max:255',
            'home_phone' => 'numeric|max:255',
            'work_phone' => 'numeric|max:255',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string',
        ]);
    }

    public function showSearchForm()
    {
        $user_id = Auth::user()->id;
        $customers = Customer::where('user_id', $user_id)->get();

        return view('dashboard/customer-profiles/search', ['customers' => $customers]);
    }

    public function showAddForm()
    {

        return view('dashboard/customer-profiles/create');
    }

    public function showClientDetailForm($id)
    {
        $customer = Customer::find($id);
        $pets = Pet::where('customer_id', $id)->get();
        $pet_count = Pet::where('customer_id', $id)
            ->count();
        $breeds = Breed::all()->sortBy("name");
        $groomers = Groomer::all();
        $appointment_data = DB::table('appointments')->get();

        return view('dashboard/customer-profiles/detail',
            [
                'customer' => $customer,
                'pet' => [
                    'datas' => $pets,
                    'count' => $pet_count
                ],
                'breeds' => $breeds,
                'groomers' => $groomers,
                'appointments' => $appointment_data,
            ]
        );
    }

    public function saveCustomer(Request $request)
    {
        $data = $request->all();

        // $validator = $this->validator( $data );
        //     if ( $validator->fails() ) {
        //         var_dump($validator);
        //         // return redirect()->action( 'Dashboard\CustomerProfilesController@showAddForm' )
        //         //                  ->withErrors( $validator )->withInput( $data );
        //     }
        // var_dump( $data );
        $user_id = Auth::user()->id;

        $result = Customer::create([
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

        return redirect('dashboard/customers/detail/' . $result['id']);
    }

    public function editCustomer(Request $request)
    {

        $data = $request->all();
        Customer::where('id', $data['customer_id'])->update([
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

        return redirect('dashboard/customers/detail/' . $data['customer_id']);
    }

    public function editPet(Request $request)
    {
        $data = $request->all();
        $path = '';
        if ($request->hasFile('pet_image')) {
            $pet_image = $request->file('pet_image');
            $fileName = $pet_image->getClientOriginalName();
            $updir = 'images/pets/';
            $path = $pet_image->move($updir, $fileName);
            $path = $updir . $fileName;
        }
        Pet::where('id', $data['pet_id'])->update([
            'name' => $data['name'],
            'breed_id' => $data['breed_id'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'is_neutered' => $data['is_neutered'],
            'note' => $data['pet_note'],
            'cut_note' => $data['pet_cut_note'],
            'alternative_contact_name' => $data['alternative_contact_name'],
            'alternative_contact_number' => $data['alternative_contact_number'],
            'vet_name' => $data['vet_name'],
            'vet_number' => $data['vet_number'],
            'vet_address' => $data['vet_address'],
            'vet_medical_note' => $data['vet_medical_note'],
//            'owner_name' => $data['owner_name'],
            'image_url' => $path,
        ]);

        return redirect('dashboard/customers/detail/' . $data['customer_id']);
    }

    public function deletecustomer($id)
    {

        return Customer::destroy($id);
        // return redirect('dashboard/customers/search/');
    }

    public function searchcustomer(Request $request)
    {
        $data = $request->all();

        if ($data['type'] == 'last_name') {
            if (strtolower($data['letter']) == 'all') {
                $customers = Customer::all();
            } else if ($data['letter'] == '0-9') {
                $customers = Customer::where('last_name', 'like', '0%')
                    ->orWhere('last_name', 'like', '1%')
                    ->orWhere('last_name', 'like', '2%')
                    ->orWhere('last_name', 'like', '3%')
                    ->orWhere('last_name', 'like', '4%')
                    ->orWhere('last_name', 'like', '5%')
                    ->orWhere('last_name', 'like', '6%')
                    ->orWhere('last_name', 'like', '7%')
                    ->orWhere('last_name', 'like', '8%')
                    ->orWhere('last_name', 'like', '9%')->get();
            } else {
                $customers = Customer::where('last_name', 'like', $data['letter'] . '%')->get();
            }
            // seach pet
        } else {
            $customers = Customer::where('last_name', 'like', '%' . $data['letter'] . '%')
                ->orWhere('first_name', 'like', '%' . $data['letter'] . '%')
                ->orWhere('mobile_phone', 'like', '%' . $data['letter'] . '%')
                ->orWhere('email', 'like', '%' . $data['letter'] . '%')
                ->orWhere('address', 'like', '%' . $data['letter'] . '%')
                ->orWhere('address2', 'like', '%' . $data['letter'] . '%')
                ->orWhere('country_state', 'like', '%' . $data['letter'] . '%')
                ->orWhere('town', 'like', '%' . $data['letter'] . '%')
                ->orWhere('post_zip_code', 'like', '%' . $data['letter'] . '%')
                ->orWhere('note', 'like', '%' . $data['letter'] . '%')
                ->orWhereHas('pets', function ($query) use ($data){
                    $query->where('name', 'like', '%' . $data['letter'] . '%')
                        ->orWhereHas('breed', function ($query) use ($data){
                            $query->where('name', 'like', '%' . $data['letter'] . '%');
                        });

                })->get();
        }
        if (!empty($customers) && $customers->count() > 0) {

            foreach ($customers as $key => $customer) {
                $pets = Pet::where('customer_id', $customer->id)->get();
                foreach ($pets as $k => $value) {
                    if ($k == count($pets) - 1) {
                        $customers[$key]['pet_results'] .= $value->name;
                    } else {
                        $customers[$key]['pet_results'] .= $value->name . ', ';
                    }
                }

            }
            echo json_encode($customers);
        } else {
            echo -1;
        }

        die;
    }

    public function deletepet($id)
    {
        return Pet::destroy($id);
        // return redirect('dashboard/customers/search/');
    }

    public function savePet(Request $request)
    {
        $data = $request->all();
        $path = '';
        if ($request->hasFile('pet_image')) {
            $pet_image = $request->file('pet_image');
            $fileName = $pet_image->getClientOriginalName();
            $updir = 'images/pets/';
            $path = $pet_image->move($updir, $fileName);
            $path = $updir . $fileName;
        }
        $result = Pet::create([
            'customer_id' => $data['customer_id'],
            'breed_id' => $data['breed_id'],
            'name' => $data['name'],
            'dob' => $data['dob'],
            'gender' => $data['gender'],
            'is_neutered' => $data['is_neutered'],
            'note' => $data['pet_note'],
            'cut_note' => $data['pet_cut_note'],
            'alternative_contact_name' => $data['alternative_contact_name'],
            'alternative_contact_number' => $data['alternative_contact_number'],
            'vet_name' => $data['vet_name'],
            'vet_number' => $data['vet_number'],
            'vet_address' => $data['vet_address'],
            'vet_medical_note' => $data['vet_medical_note'],
//            'owner_name' => $data['owner_name'],
            'image_url' => $path,
        ]);
        // var_dump( $result);
        // var_dump( $data );
        return redirect('dashboard/customers/detail/' . $data['customer_id']);
    }
}
