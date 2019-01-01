@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="background-color: #ffffff; margin: -15px -15px 0px -15px; padding: 15px 20px;"><i class="fa fa-cogs"
                                                                                                 aria-hidden="true"></i>&nbsp;Email
        Settings</h1>
@stop

@section('content')
    <div class="container-fluid" style="background-color: #ffffff; padding: 15px; border: 1px solid #ddd;">
        <form action="{{ action('Dashboard\ReminderEmailsController@save') }}" method="POST" class="form-horizontal">
            {!! csrf_field() !!}
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Save
                    </button>
                </div>
                <div class="panel-body">

                    <div class="container-fluid">
                        <h3><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;Reminders</h3>

                        <p>
                            Are a great way to remind your customers about their up and coming appointments.<br/>
                            It's great way to not only offer your clients a great service but it is also you increase
                            your income and recude no shows.
                        </p>

                        <div class="form-group">
                            <label>Send automatic reminders:</label>
                            <input class="switch-btn" type="checkbox"
                                   name="{{ config('user_settings.automatic_reminders') }}" {{ !empty($settings[config('user_settings.automatic_reminders')]) ? 'checked' : '' }} />
                        </div>

                        <div class="form-group">
                            <label>When to send 1st reminders:</label>
                            <input type="number" name="{{ config('user_settings.days_before_appointment') }}"
                                   value="{{ @$settings[config('user_settings.days_before_appointment')] }}"
                                   style="width: 70px;"/>
                            (day(s) before appointment)
                        </div>

                        <div class="form-group">
                            <label>When to send 2nd reminders:</label>
                            <input type="number" name="{{ config('user_settings.days_before_appointment_2nd') }}"
                                   value="{{ @$settings[config('user_settings.days_before_appointment_2nd')] }}"
                                   style="width: 70px;"/>
                            (day(s) before appointment)
                        </div>

                        <div class="form-group">
                            <textarea rows="20" class="tinymce-textarea"
                                      name="{{ config('user_settings.reminder_email_template') }}">{{ @$settings[config('user_settings.reminder_email_template')] }}</textarea>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@stop