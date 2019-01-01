@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
@stop
@section('content')


    @foreach($appoinment_data as $row)
        {{-- {{$row->service}} --}}
    @endforeach

    @if($settings['calendar_view'] == 'list')
        <script type="text/javascript">
            window.location = "{{route('appointment-list') }}";
        </script>
    @endif
    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function () {

            if ($("#calendar").length) {

                var minTime, maxTime;
                minTime = moment('{{ $settings['start_time'] }}', "h:mm A").format("H:mm");
                maxTime = moment('{{ $settings['end_time'] }}', "h:mm A").format("H:mm");

                var currentdate = new Date();
                var datetime = currentdate.getFullYear() + "-"
                    + (currentdate.getMonth() + 1) + "-"
                    + currentdate.getDate();

                $('#calendar').fullCalendar({
                    defaultView: '{{ $settings['calendar_view'] }}',
                    dayClick: function (date, jsEvent, view, res) {
                        if (view.name == 'agendaWeek' || view.name == 'agendaDay') {

                            date_show = convertDate(date.format());
                            $('#DateString').val('');
                            $('#DateString').val(date_show);
                            $('#DateEndString').val(date_show);
                            var new_date = new Date(date.format());


                            $('#StartTime').datetimepicker('setDate', new Date(date.format('YYYY-MM-DD HH:mm:ss')));
                            $('#EndTime').datetimepicker('setDate', new Date(date.add(1, 'hour').format('YYYY-MM-DD HH:mm:ss')));
                        }
                        else {

                            //for month view case
                            new_date = new Date(date.format());
                            date_show = new_date.getDate() + '-'
                                + (months[new_date.getMonth()]) + "-" + new_date.getFullYear();
                            $('#DateString').val('');
                            $('#DateString').val(date_show);
                            $('#DateEndString').val(date_show);
                            $('#StartTime').val('8:00 AM');
                            $('#EndTime').val('9:00 AM');
                        }
                        $('#btn-delete-appointment').hide();
                        $('#form-create-or-edit').attr("action", "{{route('appointments-create')}}");
                        $('#appointmentModal').modal('show');

                    },
                    hiddenDays: [],
                    defaultDate: datetime,
                    columnFormat: 'ddd DD-MMM',
                    allDaySlot: false,
                    slotDuration: '00:20:00',
                    schedulerLicenseKey: '0786422980-fcs-1488448993',
                    groupByDateAndResource: false,
                    height: 'auto',
                    firstDay: 1,
                    disableResizing: true,
                    disableDragging: true,
                    eventOverlap: false,
                    nowIndicator: true,
                    minTime: minTime,
                    maxTime: maxTime,
                    header:
                        {
                            left: '',
                            right: ''
                        },
                    //resources: [{"id":"1fa3ca34-2d54-4d52-800b-3e4fd3750219","name":null,"eventBackgroundColor":"#4bc5df","title":"vo nam loc ","image":null,"businessHours":[]}],
                    // defaultView: '{/{$settings['calendar_view']}}',
                    events: [
                            @foreach($appoinment_data as $row)
                        {
                            title: '{{$row->petname}} {{$row->last_name}}',
                            start: '{{$row->start_date}}T{{$row->start_time}}',
                            end: '{{$row->end_date}}T{{$row->end_time}}',
                            summary: '{{$row->notes}}',
                            load_start_date: '{{$row->start_date}}',
                            load_end_date: '{{$row->end_date}}',
                            load_start_time: '{{$row->start_time}}',
                            load_end_time: '{{$row->end_time}}',
                            groomer: '{{$row->groomerfirstname}} {{$row->groomerlastname}}',
                            groomer_id: '{{$row->groomerid}}',
                            pet_id: '{{$row->petid}}',
                            pet_name: '{{$row->petname}}',
                            appointment_id: '{{$row->id}}',
                            user: '{{$user->first_name}} {{$user->last_name}}',
                            customer: '{{$row->first_name}} {{$row->last_name}}',
                            telephone: '{{$row->home_phone}}',
                            mobile: '{{$row->mobile_phone}}',
                            work: '{{$row->work_phone}}',
                            medical: '{{$row->vet_medical_note}}',
                            cutnote: '{{$row->cut_note}}',
                            load_show_date: '{{$row->show_date}}',
                            load_show_end_date: '{{$row->show_end_date}}',
                            service: [@foreach($services as $service)@if($service->appointmentid == $row->id)['{{$service->name}}', '{{$service->unit_price}}', '{{$service->quantity}}', @if(!empty($service->notes))'{{$service->notes}}'@elseif($service->notes == null)' '@endif]@endif,@endforeach],
                        },
                        @endforeach
                    ],

                    eventClick: function (event, jsEvent, view) {
                        closePopovers();

                        $('#defaultDateString').val(event.load_start_date);
                        $('#DateString').val('');
                        $('#DateString').val(event.load_show_date);
                        $('#DateEndString').val(event.load_show_end_date);

                        $('#StartTime').val('');
                        $('#EndTime').val('');
                        $('#StartTime').datetimepicker('setDate', new Date(event.start.format('YYYY-MM-DD HH:mm:ss')));
                        var endTime = null;
                        if (event.end) {
                            endTime = new Date(event.end.format('YYYY-MM-DD HH:mm:ss'));
                        }
                        else {
                            endTime = new Date(event.start.format('YYYY-MM-DD HH:mm:ss'));
                        }
                        $('#EndTime').datetimepicker('setDate', endTime);

                        
                        $('#note-area').html(event.summary);
                        $('#pet_id').val(event.pet_id);
                        $('#groomer_id').val(event.groomer_id);
                        $('#form-create-or-edit').attr("action", "{{route('appointments-edit')}}");
                        $('#form-create-or-edit').addClass('edit2');
                        $('#form-create-or-edit .input-hidden').html("<input type='hidden' name='appointment_id' value='" + event.appointment_id + "' >");


                        $('#appointmentModal').modal('show');
                        $('#select2-pet_id-container').html(event.pet_name);
                        $('#select2-groomer_id-container').html(event.groomer);
                        $("#appointmentItems").html(' ');
                        $('#appointmentTotal').html(' ');
                        $('#btn-delete-appointment').show();
                        for (var i = 0; i < event.service.length; i++) {
                            if (event.service[i] != null) {
                                addNewRow(event.service[i][0], event.service[i][1], event.service[i][2], event.service[i][3]);
                            }

                        }
                        //Add info for Green modal by hover Pet select here:
                        $('.greenmodal').html('<h4>' + event.customer + '</h4> <br> <small>Telephone: ' + event.telephone + '</small> <br> <small>Mobile: ' + event.mobile + '</small> <br> <small>Work: ' + event.work + '</small> <br> <small>Cut Notes: ' + event.cutnote + '</small>');


                    },
                    eventRender: function (event, element) {
                        element.find('.fc-title').append("<br/><div class='EventSummary'> <i class='fa fa-sticky-note-o' aria-hidden='true'></i> &nbsp" + event.summary + '</div>');
                    },
                    eventMouseover: function (event, jsEvent, view) {
                        $(jsEvent.target).popover({
                            html: true, title: event.title, placement: 'top', container: 'body',
                            template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title btn-info "></h3><div class="popover-content"></div></div>',
                            animation: true,
                            content: '<i class="fa fa-user-circle-o bl" aria-hidden="true"></i> ' + event.customer + '<br> <i class="fa fa-codepen bl" aria-hidden="true"></i> ' + event.user + '<br> <i class="fa fa-sticky-note bl" aria-hidden="true"></i> ' + event.summary + '<br> <i class="fa fa-heartbeat bl" aria-hidden="true"></i> ' + event.medical + '<br><i class="fa fa-scissors bl" aria-hidden="true"></i> ' + event.cutnote
                        }).popover('show');
                    },
                    eventMouseout: function (event, jsEvent, view) {
                        closePopovers();
                    }
                });

                function closePopovers() {
                    $('.popover').not(this).popover('hide');
                }

                function convertDate(origin_date) {

                    var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Octo', 'Nov', 'Dec'];
                    var new_date = new Date(origin_date);
                    var strdate = new_date.getDate() + '-'
                        + (months[new_date.getMonth()]) + "-" + new_date.getFullYear();
                    return strdate;
                }

                function convertStartTime(origin_date) {
                    var dt = new Date(origin_date);
                    var h = dt.getHours(), m = dt.getMinutes();
                    if (m == 0) m = '00';
                    if (m < 10 && m > 0) m = '0' + m;
                    var start_time = '';
                    if (h == 12) {
                        start_time = 12 + ':' + m + ' PM';
                    }
                    else {
                        start_time = (h > 12) ? (h - 12 + ':' + m + ' PM') : (h + ':' + m + ' AM');
                    }
                    return start_time;


                }

                function convertEndTime(origin_date) {
                    var dt = new Date(origin_date);
                    var h = dt.getHours(), m = dt.getMinutes();
                    h = h + 1;
                    if (m == 0) m = '00';
                    if (m < 10 && m > 0) m = '0' + m;
                    var end_time = '';
                    if (h == 12) {
                        end_time = 12 + ':' + m + ' PM';
                    }
                    else {
                        end_time = (h > 12) ? (h - 12 + ':' + m + ' PM') : (h + ':' + m + ' AM');
                    }
                    return end_time;
                }


                $('#calendar').fullCalendar('gotoDate', datetime);
            }
            
            jQuery('#btn-delete-appointment').click(function(event) {
                event.preventDefault();
                var c = confirm("Confirm Delete?");
                if (c == true) {
                    var url = '{{route("appointments-delete") }}';
                    var data = {
                        'appointment_id': $('#form-create-or-edit .input-hidden input[name=appointment_id]').val(),
                        "_token": "{{ csrf_token() }}"
                    };

                    $.post(url, data, function (response) {

                        if (response.status == 0) {
                            alert(response.message);
                        }else{
                            location.reload();
                        }
                    }, 'json');
                }
                    

            });

        });
    </script>

    <div class="container-fluid" style="background-color: #ffffff; margin: -15px -15px 0px -15px;">
        <div class="btn-group" id="123">
            <button type="button" class="btn btn-default  btn-rad " id="navLeft" title="Previous"><i
                        class="fa fa-arrow-left"></i></button>
            <button type="button" class="btn btn-default btn-rad " id="navRight" title="Next"><i
                        class="fa fa-arrow-right"></i></button>
            <button type="button" class="btn btn-default input-group date " id="CalMeNow" title="Navigate"><i
                        class="fa fa-calendar"></i> <label id="DisplayDate"></label></button>
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-success  md-trigger" id="newAppointment" title="New Appointment"
                    onclick="return LoadAppointment();"><i class="fa fa-plus"></i> Appointment
            </button>
            <button type="button" class="btn btn-success  dropdown-toggle" data-toggle="dropdown" title="more...">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a onclick="return LoadAppointment();"> <i class="fa fa-calendar-o"></i> Appointment</a></li>
                <!-- <li><a onclick="return LoadRepeatAppointment();"><i class="fa fa-calendar-plus-o"></i> Advance Appointment</a></li>
                <li><a onclick="return LoadEvent();"> <i class="fa fa-flag"></i> Event</a></li> -->
            </ul>

            <!-- <button type="button" class="btn btn-success  md-trigger" id="newSms" title="Send SMS" data-toggle="modal" data-target="#smsModal"><i class=" fa fa-comments"></i></button>
            <button type="button" class="btn btn-success  btn-rad md-trigger" id="newEmail" title="Send Email" data-toggle="modal" data-target="#emailModal"><i class=" fa fa-envelope-o"></i></button> -->
        </div>
        <div class="btn-group">
            <button type="button" class="btn btn-info  btn-rad " id="navToday" title="Today"><i
                        class="fa fa-calendar-o"></i> Today
            </button>
            <button type="button" class="btn btn-info  btn-rad" id="viewDay">Day</button>
            <button type="button" class="btn btn-info  md-trigger" id="viewWeek">Week</button>
            <button type="button" class="btn btn-info" id="viewMonth">Month</button>
            <a href="{{ route('appointment-list') }}" type="button" class="btn btn-info  btn-rad">List</a>
        </div>
        <div id="calendar">
        </div>
    </div>
    <div class="greenmodal"></div>
    <!-- Appointment Modal -->
    <div class="modal" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="color-background-info modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title"><i class="fa fa-calendar-o"></i>&nbsp;Appointment</h3>
                </div>
                <div class="modal-body">
                    <div id="appPlaceholder">
                        <form action="{{ route('appointments-create') }}" method="post" id="form-create-or-edit">
                            {!! csrf_field() !!}
                            <div class="tab-container">
                                <div class="input-hidden"></div>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#details" data-toggle="tab" aria-expanded="true"><i
                                                    class="fa fa-user"></i> Details</a></li>
                                    <li class=""><a href="#services" data-toggle="tab" aria-expanded="false"><i
                                                    class="fa fa-thumbs-o-up"></i> Services</a></li>
                                </ul>
                                <div class="tab-content"
                                     style="border: 1px solid #dddddd; border-top: 0px; padding: 15px;">
                                    <div class="tab-pane cont active" id="details">
                                        <div class="container-fluid">
                                            <label for="Name" class="col-sm-2 control-label">Day:</label>
                                            <div class="col-sm-6">
                                                <input class="form-control date datetime" id="DateString"
                                                       name="DateString" data-min-view="2" data-date-format="dd-M-yyyy"
                                                       pattern="^(([0-9])|([0-2][0-9])|([3][0-1]))\-(Jan|jan|Feb|feb|Mar|mar|Apr|apr|May|may|jun|Jun|jul|Jul|aug|Aug|sep|Sep|oct|Oct|nov|Nov|dec|Dec)\-\d{4}$"
                                                       title="example: 12-Nov-2015" maxlength="11" type="text"
                                                       required="required" onchange="Datechange();">
                                                       <input type="hidden" id="defaultDateString" type="text" >
                                            </div>
                                            <div class="col-sm-6">
                                                <input class="form-control date datetime" value="" id="DateEndString"
                                                       name="DateEndString" data-min-view="2"
                                                       data-date-format="dd-M-yyyy"
                                                       pattern="^(([0-9])|([0-2][0-9])|([3][0-1]))\-(Jan|jan|Feb|feb|Mar|mar|Apr|apr|May|may|jun|Jun|jul|Jul|aug|Aug|sep|Sep|oct|Oct|nov|Nov|dec|Dec)\-\d{4}$"
                                                       title="example: 12-Nov-2015" maxlength="11" type="hidden"
                                                       required="required">
                                            </div>
                                            <div class="Spacer"></div>
                                            <label for="Name" class="col-sm-2 control-label">From:</label>
                                            <div class="col-sm-4 ">
                                                <input class="form-control sTime" value="" name="StartTime"
                                                       id="StartTime" data-min-view="2" data-date-format="H:ii P"
                                                       pattern="^(1[012]|[1-9]):[0-5][0-9](\s)?([aAP][mM])$"
                                                       title="example 11:00 AM" type="text" required="required">
                                                <span class="field-validation-valid" data-valmsg-for="StartTime"
                                                      data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="Spacer"></div>
                                            <!--<label for="Name" class="col-sm-2 control-label">End:</label>-->
                                            <label for="Name" class="col-sm-2 control-label">To:</label>
                                            <div class="col-sm-4">
                                                <input class="form-control eTime" value="" name="EndTime" id="EndTime"
                                                       data-min-view="2" data-date-format="H:ii P"
                                                       pattern="^(1[012]|[1-9]):[0-5][0-9](\s)?([aAP][mM])$"
                                                       title="example 2:00 PM" type="text" required="required">
                                                <span class="field-validation-valid" data-valmsg-for="EndTime"
                                                      data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="Spacer"></div>

                                            <label for="Name" class="col-sm-2 col-md-2 control-label">Groomer:</label>
                                            <div class="col-sm-10 col-md-10">
                                                <div class="input-group">
                                                    <select class="form-control select2 hide-arrow" id="groomer_id"
                                                            name="groomer_id" style="width: 100%;">
                                                        @foreach( $groomers as $groomer)
                                                            <option value="{{$groomer->id}}">{{$groomer->first_name}} {{$groomer->last_name}}</option>
                                                        @endforeach
                                                    </select>
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-info search_pet" type="button"
                                                            title="type to search"><i class="fa fa-search"></i></button>
                                                </span>
                                                    {{--                 <input id="ResourceName2" class="form-control" name="ResourceName" value="{{$user->first_name}} {{$user->first_name}}" autocomplete="off" type="text" value="">
                                                                    <span class="input-group-btn">
                                                                        <button class="btn btn-info" type="button" onclick="loadResource();" title="type to search"><i class="fa fa-search"></i></button>
                                                                    </span> --}}
                                                </div>
                                                <input id="ResourceId" name="ResourceId" value="{{$user->id}}"
                                                       type="hidden">
                                                <input id="AppointmentHeader" name="AppointmentHeader" value=""
                                                       type="hidden">
                                            </div>
                                            <div class="Spacer"></div>
                                            <label for="Name" class="col-sm-2 col-md-2 control-label">Pet:</label>
                                            <div class="col-sm-10 col-md-10">
                                                <div class="input-group">
                                                    <select class="form-control select2 hide-arrow" id="pet_id"
                                                            name="pet_id" style="width: 100%;" required="required">
                                                        @foreach( $pets as $pet)
                                                            <option value="{{$pet->id}}">{{ $pet->name }}
                                                                @foreach ($customers as $customer)
                                                                    @if ($pet->customer_id == $customer->id )
                                                                        ({{$customer->first_name}} {{$customer->last_name}}
                                                                        )
                                                                        [{{ \App\Services\BreedService::getBreedName($pet->breed_id) }}
                                                                        ]
                                                                    @endif
                                                                @endforeach
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="input-group-btn">
                                                    <button class="btn btn-info" type="button" onclick="loadClient();"
                                                            title="type to search"><i class="fa fa-search"></i></button>
                                                </span>
                                                </div>
                                            </div>
                                            <div class="Spacer"></div>
                                            <div class="col-xs-12">
                                                <div id="rating">
                                                </div>
                                            </div>
                                            <label for="Notes" class="col-sm-12 col-md-2 control-label">Notes:</label>
                                            <div class="col-sm-12 col-md-10">
                                                <textarea id="note-area" class="form-control" cols="20" id="Notes"
                                                          maxlength="400" name="Notes" rows="3" tabindex="6"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="services">
                                        <div class="form-horizontal" role="form">
                                            <script type="jquery/tmpl" id="jobItemTemplate">
                                        <div data-rowid="${id}" id="itemRow_${id}">
                                            <div style="visibility:hidden" id="AppointmentItemEntry_error_${id}"><img src="/Content/Images/Icons/error.png" title="Incomplete item" /></div>
                                            <div class="col-sm-12 col-md-5 minipadding">
                                                <input name="AppointmentItemEntry_item_${id}" type="text" value="${item}" id="AppointmentItemEntry_item_${id}" placeholder="Item" class="form-control-small" />
                                            </div>
                                            <div class="col-sm-12 col-md-2 minipadding">
                                                ${currency}<input id="price_${id}" data-rowid="${id}" name="AppointmentItemEntry_price_${id}" type="number" value="${price}" step="any" class="form-control-small"/>
                                            </div>
                                            <div class="col-sm-12 col-md-1 minipadding">
                                                <input id="quantity_${id}" data-rowid="${id}" name="AppointmentItemEntry_quantity_${id}" type="number" value="${quantity}" step="any" class="form-control-small"/>
                                            </div>
                                            <div class="col-sm-12 col-md-1 minipadding">
                                                <span id="tax_${id}">0.0</span>
                                            </div>
                                            <div class="col-sm-12 col-md-1 minipadding">
                                                <span id="total_${id}" class="lineTotal">0.0</span>
                                            </div>

                                            <div class="col-sm-6 col-md-2">
                                                <a class="label label-danger" onclick='removeRow(${id})' title="Remove"><i class="fa fa-times"></i></a>
                                            </div>
                                            <input type="hidden" style="width:100%;" name="AppointmentItemEntry_notes_${id}" placeholder="notes"/>
                                        </div>

                                            </script>
                                            <button type="button" onclick="addNewRow('','',0.00,'');return false;"
                                                    class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add
                                                Service\Item
                                            </button>
                                            <hr>
                                            <div class="content">
                                                <div class="container-fluid">
                                                    <div class="col-md-5 minipadding text-left">Name</div>
                                                    <div class="col-md-2 minipadding text-left">Price</div>
                                                    <div class="col-md-1 minipadding text-left">Qty</div>
                                                    <div class="col-md-1 minipadding text-left">Tax</div>
                                                    <div class="col-md-1 minipadding text-left">Total</div>
                                                    <div class="col-md-2"></div>
                                                </div>
                                                <div class="container-fluid" id="appointmentItems"></div>
                                                <hr>
                                                <div class="col-md-6 total text-capitalize text-b" width="100"><strong>Total: </strong>
                                                </div>
                                                <div class="col-md-6 total">
                                                    <span id="appointmentTotal"><strong>0</strong></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input id="clientId" name="clientId" type="hidden">
                            <input id="petId" name="petId" type="hidden">
                            <input id="appointmentId" name="appointmentId" type="hidden">
                            <p style="padding-top: 1em; text-align: right;">
                                <button id="btn-delete-appointment" value="button" style="display:none;"
                                        class="btn btn-danger"><i
                                            class="fa fa-save"></i> Delete
                                </button>
                                <button id="btn-sumit-appointment" type="submit" value="button"
                                        onclick="return ValidateAppointment();" class="btn btn-info"><i
                                            class="fa fa-save"></i> Save
                                </button>
                            </p>
                            <div id="clientForm2"></div>
                            <p></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
