<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\DB;

class SettingService {
	public static function GetSetting( $user, $settingName ) {
		$setting = $user->settings()->where( 'name', '=', $settingName )->first();
		if ( $setting ) {
			return $setting->value;
		}

		return null;
	}

	public static function GetSettings( $user ) {
		$settings = DB::table('settings')->where('user_id', '=', $user->id)->get();
		$res      = [];
		foreach ( $settings as $setting ) {
			$res[ $setting->name ] = $setting->value;
		}

		return $res;
	}

	public static function SetSetting( $user, $settingName, $settingValue ) {
		$setting = $user->settings()->where( 'name', '=', $settingName )->first();
		if ( $setting ) {
			$setting->value = $settingValue;
			$setting->save();
		} else {
			$settingData = [
				'name'    => $settingName,
				'value'   => $settingValue,
				'user_id' => $user->id
			];
			self::CreateSetting( $settingData );
		}

		return $setting;
	}

	public static function SetSettings( $user, $settings ) {
		foreach ( $settings as $settingName => $settingValue ) {
			self::SetSetting( $user, $settingName, $settingValue );
		}
	}

	public static function CreateSetting( $data ) {
		DB::beginTransaction();
		try {
			$setting = Setting::create( $data );
			DB::commit();

			return $setting;
		} catch ( \Exception $e ) {
			DB::rollback();

			return false;
		}
	}

	public static function InitUserSettings( $user ) {
		$emailReminderTemplate = config( 'user_settings.reminder_email_template_default' );
		self::SetSetting( $user, config( 'user_settings.reminder_email_template' ), $emailReminderTemplate );
		self::SetSetting( $user, config( 'user_settings.days_before_appointment' ), 7 );
		self::SetSetting( $user, config( 'user_settings.days_before_appointment_2nd' ), 1 );
		self::SetSetting( $user, config( 'user_settings.calendar_view' ), 'month' );
		self::SetSetting( $user, config( 'user_settings.start_time' ), '8:00 AM' );
        self::SetSetting( $user, config( 'user_settings.end_time' ), '6:00 PM' );

    }
}