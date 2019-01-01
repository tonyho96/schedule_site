@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="background-color: #ffffff; margin: -15px -15px 0px -15px; padding: 15px 20px;"><i class="fa fa-user"
                                                                                                 aria-hidden="true"></i>&nbsp;Profile
    </h1>
@stop

@section('content')
    <div class="container-fluid"
         style="background-color: #ffffff; padding: 15px; border: 1px solid #ddd; max-width: 767px; margin: 0 auto;">
        <form action="" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <input id="first-name" type="text" class="form-control" name="first-name" value="{{$first_name}}">
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <input id="last-name" type="text" class="form-control" name="last-name" value="{{$last_name}}">
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
                    <input id="company-name" type="text" class="form-control" name="company-name"
                           value="{{$company_name}}">
                </div>
            </div>

            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-globe" aria-hidden="true"></i></span>
                    <input id="country" type="text" class="form-control" name="country-type" value="{{$country_type}}"/>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success" style="display: block; width: 100%">
                    <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;Save
                </button>
            </div>


        </form>
    </div>
@stop