@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="background-color: #ffffff; margin: -15px -15px 0px -15px; padding: 15px 20px;"><i
                class="fa fa-fw fa-cogs" aria-hidden="true"></i>&nbsp;Schedule Setting</h1>
@stop

@section('content')
    <div class="container-fluid"
         style="background-color: #ffffff; padding: 15px; border: 1px solid #ddd; max-width: 767px; margin: 0 auto;">
        <form id="settingForm" action="{{ route('edit-schedule-setting') }}" method="POST" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label>Schedule view (default)</label>
                <select name="calendar_view" style="width: 100%;" class="form-control">
                    <option value="agendaDay" @if($calendar_view == 'agendaDay') selected @endif>Day</option>
                    <option value="agendaWeek" @if($calendar_view == 'agendaWeek') selected @endif>Week</option>
                    <option value="month" @if($calendar_view == 'month') selected @endif>Month</option>
                    <option value="list" @if($calendar_view == 'list') selected @endif>List</option>
                </select>

            </div>
            <div class="form-group">
                <label>Business Hours</label>
                {{--<input type="radio" name="business_hours" value="yes" style="margin-right: 10px" @if($business_hours == 'yes') {{'checked'}} @endif >Yes--}}
                {{--<input type="radio" name="business_hours" value="no"   style="margin-right: 10px; margin-left: 10px;" @if($business_hours == 'no') {{'checked'}} @endif >No--}}
                <label for="StartTime" class="col-sm-2 control-label">From:</label>
                <div class="col-sm-4 ">
                    <input class="form-control sTime" value="" name="StartTime" id="StartTime"
                           data-min-view="2" type="text"
                           required="required" data-default-date="{{ date('Y-m-d H:i:s', strtotime($start_time)) }}">
                    <span class="field-validation-valid" data-valmsg-for="StartTime" data-valmsg-replace="true"></span>
                </div>
                <div class="Spacer"></div>
                <!--<label for="Name" class="col-sm-2 control-label">End:</label>-->
                <label for="EndTime" class="col-sm-2 control-label">To:</label>
                <div class="col-sm-4">
                    <input class="form-control eTime" value="" name="EndTime" id="EndTime"
                           data-min-view="2" title="example 2:00 PM" type="text"
                           required="required" data-default-date="{{ date('Y-m-d H:i:s', strtotime($end_time)) }}">
                    <span class="field-validation-valid" data-valmsg-for="EndTime" data-valmsg-replace="true"></span>
                </div>

            </div>

            <div class="form-group">
                <label for="timezone">Timezone (now: {{ date('Y-m-d H:i:s') }})</label>
                <select id="timezone" name="timezone" style="width: 100%;" class="form-control">
                    @foreach(DateTimeZone::listIdentifiers() as $timezoneItem)
                        <option @if(@$timezone == $timezoneItem) selected @endif>{{ $timezoneItem }}</option>
                    @endforeach
                </select>

            </div>
            <div class="form-group">
                <button type="submit" value="button" class="btn btn-success" onclick="return validateSetting()"
                        style="display: block; width: 100%">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save
                </button>
            </div>


        </form>
    </div>
@stop