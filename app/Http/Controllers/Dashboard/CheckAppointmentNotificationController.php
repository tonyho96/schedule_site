<?php

namespace App\Http\Controllers\Dashboard;

use Carbon\Carbon;
use Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SettingService;
use DB;
use App\Models\customer;
use Auth;

class CheckAppointmentNotificationController extends Controller
{
    public function index()
    {
        // get date send mail setting
        $user = Auth::user();
        $settings = SettingService::GetSettings($user);
        $day_1 = $settings['days_before_appointment'];
        $day_2 = $settings['days_before_appointment_2nd'];
        $reminder_email_template = $settings['reminder_email_template'];
        $appoinment_data = DB::table('appointments')
            ->whereDate('start_date', '=', Carbon::today()->addDay($day_1))
            ->where('status_1', '<>', 1)
            ->join('users', 'appointments.user_id', '=', 'users.id')
            ->join('pets', 'appointments.pet_id', '=', 'pets.id')
            ->select('appointments.id', 'users.last_name', 'pets.name', 'appointments.start_date', 'appointments.start_time', 'users.company_name', 'users.country_type', 'pets.customer_id', 'users.first_name')
            ->get();
        foreach ($appoinment_data as $data) {
            $customer = Customer::find($data->customer_id);
            $reminder_email = str_replace('[FirstName]', $customer->first_name, $reminder_email_template);
            $reminder_email = str_replace('[PetName]', $data->name, $reminder_email);
            $reminder_email = str_replace('[When]', $data->start_date . " at " . $data->start_time, $reminder_email);
            $reminder_email = str_replace('[BusinessName]', $data->first_name . " " . $data->last_name, $reminder_email);
            $reminder_email = str_replace('[BusinessContactDetails]', $data->company_name . " " . $data->country_type, $reminder_email);
            Mail::raw($reminder_email, function ($message) use ($customer) {
                $message->to($customer->email);
                $message->subject('Appointment notification');
            });
            echo $customer->email;

            DB::table('appointments')->where('id', $data->id)->update(['status_1' => 1]);
        }
        $appoinment_data_2 = DB::table('appointments')
            ->whereDate('start_date', '=', Carbon::today()->addDay($day_2))
            ->where('status_2', '<>', 1)
            ->join('users', 'users.id', '=', 'appointments.user_id')
            ->join('pets', 'pets.id', '=', 'appointments.pet_id')
            ->select('appointments.id', 'users.last_name', 'pets.name', 'appointments.start_date', 'appointments.start_time', 'users.company_name', 'users.country_type', 'pets.customer_id', 'users.first_name')
            ->get();
        foreach ($appoinment_data_2 as $data2) {
            $customer = Customer::find($data2->customer_id);
            $reminder_email = str_replace('[FirstName]', $customer->first_name, $reminder_email_template);
            $reminder_email = str_replace('[PetName]', $data2->name, $reminder_email);
            $reminder_email = str_replace('[When]', $data2->start_date . " at " . $data2->start_time, $reminder_email);
            $reminder_email = str_replace('[BusinessName]', $data2->first_name . " " . $data2->last_name, $reminder_email);
            $reminder_email = str_replace('[BusinessContactDetails]', $data2->company_name . " " . $data2->country_type, $reminder_email);
            Mail::raw($reminder_email, function ($message) use ($customer) {
                $message->to($customer->email);
                $message->subject('Appointment notification');
            });
            echo $customer->email;
            DB::table('appointments')->where('id', $data2->id)->update(['status_2' => 1]);

        }

        // var_dump( $appoinment_data );

        // var_dump( $appoinment_data_2 );
        // return view('dashboard/appointment-notification/index');
    }
}
