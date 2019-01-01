@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="background-color: #ffffff; margin: -15px -15px 0px -15px; padding: 15px 20px;"><i class="fa fa-user"
                                                                                                 aria-hidden="true"></i>&nbsp;Change
        Password</h1>
@stop

@section('content')
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="container-fluid" style="background-color: #ffffff; padding: 15px; border: 1px solid #ddd;">
        <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="submit" class="btn btn-primary" id="submit-password-btn" disabled>
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Save
                    </button>
                </div>
                <div class="panel-body">

                    <div class="tab-content" style="border: 1px solid #ddd; border-top: 0px; padding: 0px 15px;">
                        <span id='message' style="font-size: 25px;"></span>
                        <div id="details" class="tab-pane fade in active">
                            <br/><br/>

                            <div class="form-group">
                                <label for="current-password" class="col-sm-2 control-label">Current Password: </label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="current-password"
                                           name="current-password"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new-password" class="col-sm-2 control-label">New Password:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="new-password" name="new-password"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirm-new-password" class="col-sm-2 control-label">Confirm New
                                    Password:</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="confirm-new-password"
                                           name="confirm-new-password"/>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
@push('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#current-password, #new-password, #confirm-new-password').on('input', function () {
                if ($('#new-password').val() == $('#confirm-new-password').val() && $('#current-password').val() != '' && $('#new-password').val() != '' && $('#confirm-new-password').val() != '') {
                    $('#submit-password-btn').removeAttr("disabled");
                    $('#message').html('');
                } else if ($('#current-password').val() == '') {
                    $('#submit-password-btn').prop('disabled', true);
                    $('#message').html('Current Password is empty').css('color', 'red');
                } else if ($('#new-password').val() != '' && $('#confirm-new-password').val() != '') {
                    $('#submit-password-btn').prop('disabled', true);
                    $('#message').html('Password Not Matching').css('color', 'red');
                }
            });
        });
    </script>
@endpush
