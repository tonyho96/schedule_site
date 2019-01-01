<?php

namespace App\Http\Controllers\Dashboard;

use App\Services\SettingService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReminderEmailsController extends Controller
{
    public function index()
    {
        $settings = SettingService::GetSettings(Auth::user());

        return view('dashboard/reminder-emails/index', compact('settings'));
    }

    public function save(Request $request)
    {
        $settings = $request->all();
        unset($settings['_token']);

        if (!isset($settings[config('user_settings.automatic_reminders')])) {
            $settings[config('user_settings.automatic_reminders')] = null;
        }
        SettingService::SetSettings(Auth::user(), $settings);

        return redirect()->action('Dashboard\ReminderEmailsController@index');
    }

    public function runCron()
    {

    }
}