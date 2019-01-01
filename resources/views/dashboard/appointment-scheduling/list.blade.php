@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="background-color: #ffffff; margin: -15px -15px 0px -15px; padding: 15px 20px;"><i class="fa fa-calendar"
                                                                                                 aria-hidden="true"></i>&nbsp;Schedule
    </h1>
@stop

@section('content')
    <div id="appointment-list" class="container-fluid"
         style="background-color: #ffffff; padding: 15px; border: 1px solid #ddd;">
        <h3>Appointments</h3>
        <div class="panel-group accordion accordion-semi" id="accordion4">

            @foreach($appointment_data as $row)

                <div class="panel panel-default">
                    <div class="panel-heading primary">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion4"
                               href="#764be3d9-e677-4446-a240-8a31faa66686" class="collapsed">
                                <i class="fa fa-angle-right"></i>{{ date_format(new DateTime($row->start_date), 'd-M-Y') }} {{ date_format(new DateTime($row->start_time), 'g:i: A') }}
                            </a>
                        </h4>
                    </div>
                    <div id="764be3d9-e677-4446-a240-8a31faa66686" class="panel-collapse collapse in"
                         style="height: auto;">
                        <div class="panel-body">
                            <div><i class="fa fa-paw" title="Name"></i> {{$row->name}} {{$row->last_name}} </div>
                            <div><i class="fa fa-star-o" title="Breed"></i> Breed (not set)</div>
                            <div><i class="fa fa-search" title="View"></i> <a
                                        href="{{route('detail', ['id' => $row->id])}}">View</a></div>
                            <div><i class="fa fa-file-o" title="Appointment notes"></i> {{$row->notes}}</div>
                            <div><i class="fa fa-scissors" title="Cut notes"></i> {{$row->cut_note}}</div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
@stop