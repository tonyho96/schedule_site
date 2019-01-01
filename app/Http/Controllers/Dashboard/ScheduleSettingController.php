<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use Request;
use App\Services\SettingService;
use Illuminate\Support\Facades\DB;

class ScheduleSettingController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $settings = SettingService::GetSettings($user);

        return view('dashboard/schedulesetting/index', [
            'calendar_view' => isset($settings['calendar_view']) ? $settings['calendar_view'] : '',
            'start_time' => isset($settings['start_time']) ? $settings['start_time'] : '',
            'end_time' => isset($settings['end_time']) ? $settings['end_time'] : '',
            'timezone' => isset($settings['timezone']) ? $settings['timezone'] : 'UTC',
        ]);
    }

    public function editScheduleSetting(Request $request)
    {
        $user = Auth::user();
        SettingService::SetSetting($user, 'calendar_view', Request::input('calendar_view'));
        SettingService::SetSetting($user, 'start_time', Request::input('StartTime'));
        SettingService::SetSetting($user, 'end_time', Request::input('EndTime'));
        SettingService::SetSetting($user, 'timezone', Request::input('timezone'));


        return redirect('dashboard/account/schedule');
    }
}
