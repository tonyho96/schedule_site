<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pet;
use App\Models\Customer;
use App\Models\Groomer;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use DB;
use App\Quotation;
use App\Services\SettingService;

class AppointmentSchedulingController extends Controller
{
    public function index()
    {
        // $appoinment_data = DB::table('appointments')->get();

        $appoinment_data = DB::table('appointments')
            ->join('pets', 'appointments.pet_id', '=', 'pets.id')
            ->join('customers', 'pets.customer_id', '=', 'customers.id')
            ->join('groomers', 'appointments.groomer_id', '=', 'groomers.id')
            ->select('appointments.*', 'pets.name as petname', 'pets.id as petid', 'customers.last_name', 'customers.home_phone', 'customers.work_phone', 'customers.mobile_phone', 'customers.first_name', 'groomers.id as groomerid', 'groomers.first_name as groomerfirstname', 'groomers.last_name as groomerlastname', 'pets.vet_medical_note', 'pets.cut_note')
            ->where('appointments.user_id',Auth::user()->id)
            ->get();
        $services = DB::table('appointments_services')
            ->join('appointments', 'appointments_services.appointment_id', '=', 'appointments.id')
            ->join('services', 'appointments_services.service_id', '=', 'services.id')
            ->select('services.*', 'appointments.id as appointmentid')
            ->get();
        $user = Auth::user();
        $settings = SettingService::GetSettings($user);
        $pets = Pet::all();
        $groomers = Groomer::where('user_id', $user->id)->get();
        $customers = Customer::where('user_id', $user->id)->get();
        $first_customers_id = '';
        foreach ($customers as $key => $customer) {
            if ($key == 0) {
                $first_customers_id = $customer->id;
            }
        }
        if (!empty($settings['timezone'])){
            date_default_timezone_set($settings['timezone']);
        }else{
            date_default_timezone_set('UTC');
        }
        foreach($appoinment_data as $appoinment){
            if(isset($appoinment->start_date)){
                $appoinment->show_date = date('d-M-Y',strtotime($appoinment->start_date));
            }
            if(isset($appoinment->end_date)){
                $appoinment->show_end_date = date('d-M-Y',strtotime($appoinment->end_date));
            }
        }
        foreach ($appoinment_data as $data){
           $data->notes = str_replace( array( "\n", "\r" ), array( "\\n", "\\r" ), $data->notes  );
        }
        
        // var_dump($settings);
        return view('dashboard/appointment-scheduling/index', [
            'appoinment_data' => $appoinment_data,
            'user' => $user,
            'customers' => $customers,
            'pets' => $pets,
            'first_customers_id' => $first_customers_id,
            'groomers' => $groomers,
            'services' => $services,
            'settings' => $settings]);
    }

    public function searchPet(Request $request)
    {
        $data = $request->all();
        $pets = Pet::where('customer_id', $data['customer_id'])->get();
        echo json_encode($pets);
    }

    public function getList()
    {

        $appointment_data = DB::table('appointments')
            ->join('pets', 'appointments.pet_id', '=', 'pets.id')
            ->join('customers', 'pets.customer_id', '=', 'customers.id')
            ->select('customers.id', 'appointments.start_date', 'appointments.start_time', 'appointments.notes', 'pets.name', 'pets.cut_note', 'customers.last_name')
            ->get();

        return view('dashboard/appointment-scheduling/list', ['appointment_data' => $appointment_data]);
    }

    private function appointmentValidator($inputs)
    {
        return Validator::make($inputs, [

        ]);
    }

    public function createAppointment(Request $request)
    {
        $inputs = $request->all();
        $validator = $this->appointmentValidator($inputs);
        $userID = \Auth::user()->id;
        if ($validator->fails()) {
            return redirect()->action('Dashboard\AppointmentSchedulingController@index')
                ->withErrors($validator)->withInput($inputs);
        }

        $appointment_id = DB::table('appointments')->insertGetId(
            [
                'start_date' => date("Y-m-d", strtotime($inputs['DateString'])),
                'start_time' => date("H:i:s", strtotime($inputs['StartTime'])),
                'end_date' => date("Y-m-d", strtotime($inputs['DateString'])),
                'end_time' => date("H:i:s", strtotime($inputs['EndTime'])),
                'pet_id' => $inputs['pet_id'],
                'groomer_id' => $inputs['groomer_id'],
                'user_id' => $userID,
                'notes' => $inputs['Notes'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        );
        if ($appointment_id) {
            $service_inputs = [];
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'AppointmentItemEntry') !== false) {
                    $pos = abs((int)filter_var($key, FILTER_SANITIZE_NUMBER_INT));
                    $service_key = str_replace('AppointmentItemEntry_', '', $key);
                    $service_key = str_replace('_' . $pos, '', $service_key);
                    $service_inputs[$pos][$service_key] = $value;
                }
            }
            if (!empty($service_inputs)) {
                foreach ($service_inputs as $key => $value) {


                    $service_id = DB::table('services')->insertGetId(
                        [
                            'name' => $value['item'],
                            'unit_price' => $value['price'],
                            'quantity' => $value['quantity'],
                            'notes' => $value['notes'],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]
                    );
                    if ($service_id) {
                        $service_id = DB::table('appointments_services')->insertGetId(
                            [
                                'appointment_id' => $appointment_id,
                                'service_id' => $service_id,
                            ]
                        );
                    }
                }
            }
        }


        return redirect()->action('Dashboard\AppointmentSchedulingController@index')->with('message', 'Your appointment is successfully created');
    }


    public function editAppointment(Request $request)
    {


        $inputs = $request->all();
        $validator = $this->appointmentValidator($inputs);
        $userID = \Auth::user()->id;
        if ($validator->fails()) {
            return redirect()->action('Dashboard\AppointmentSchedulingController@index')
                ->withErrors($validator)->withInput($inputs);
        }

        if (DB::table('appointments')->where('id', $inputs['appointment_id'])->update(
            [
                'start_date' => date("Y-m-d", strtotime($inputs['DateString'])),
                'start_time' => date("H:i:s", strtotime($inputs['StartTime'])),
                'end_date' => date("Y-m-d", strtotime($inputs['DateEndString'])),
                'end_time' => date("H:i:s", strtotime($inputs['EndTime'])),
                'pet_id' => $inputs['pet_id'],
                'groomer_id' => $inputs['groomer_id'],
                'user_id' => $userID,
                'notes' => $inputs['Notes'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        )
        ) {
            $appointment_id = $inputs['appointment_id'];
            $service_inputs = [];
            foreach ($inputs as $key => $value) {
                if (strpos($key, 'AppointmentItemEntry') !== false) {
                    $pos = abs((int)filter_var($key, FILTER_SANITIZE_NUMBER_INT));
                    $service_key = str_replace('AppointmentItemEntry_', '', $key);
                    $service_key = str_replace('_' . $pos, '', $service_key);
                    $service_inputs[$pos - 1][$service_key] = $value; // $pos-1 starts from 0
                }
            }

            if (!empty($service_inputs)) {
                $service_ids = DB::table('appointments_services')
                    ->where('appointment_id', '=', $appointment_id)
                    ->orderBy('service_id', 'asc')
                    ->pluck('service_id');


                //Delete in appointments_services table
                DB::table('appointments_services')
                    ->where('appointment_id', '=', $appointment_id)
                    ->delete();

                //Delete in services table
                foreach ($service_ids as $service_id) {
                    $model = DB::table('services')
                        ->where('id', '=', $service_id);
                    if ($model) {
                        $model->delete();
                    }
                }


                foreach ($service_inputs as $key => $value) {


                    $service_id = DB::table('services')->insertGetId(
                        [
                            'name' => $value['item'],
                            'unit_price' => $value['price'],
                            'quantity' => $value['quantity'],
                            'notes' => $value['notes'],
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]
                    );
                    if ($service_id) {
                        $service_id = DB::table('appointments_services')->insertGetId(
                            [
                                'appointment_id' => $appointment_id,
                                'service_id' => $service_id,
                            ]
                        );
                    }
                }

            }
        }


        return redirect()->action('Dashboard\AppointmentSchedulingController@index')->with('message', 'Your appointment is successfully updated');
    }

    public function deleteAppointment(Request $request)
    {

        try {
            DB::beginTransaction();
            $inputs = $request->all();
            $appointment_id = $inputs['appointment_id'];
            $service_ids = DB::table('appointments_services')
                    ->where('appointment_id', '=', $appointment_id)
                    ->orderBy('service_id', 'asc')
                    ->pluck('service_id');
            
            DB::table('appointments_services')
                ->where('appointment_id', '=', $appointment_id)
                ->delete();
            if ($service_ids) {
                    foreach ($service_ids as $service_id) {
                        $model = DB::table('services')
                            ->where('id', '=', $service_id);
                        if ($model) {
                            $model->delete();
                        }
                    }
                }
            DB::table('appointments')->where('id', '=', $appointment_id)->delete();
            DB::commit();

            return json_encode([
                'status' => 1,
                'message' => 'Your appointment is successfully deleted'
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return json_encode([
                'status' => 0,
                'message' => 'Fail to delete appointment'
            ]);
        }

    }
}