@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content')
    <div class="container-fluid" style="margin: -30px -15px 0px -15px;">
        <div class="row">
            <div class="col-md-3 col-sm-4 border-float-right">
                <h2 class="page-title">Groomer</h2>
                <p class="description">
                    {{$groomer->first_name}} {{$groomer->last_name}}<br>
                    <i class="fa fa-mobile-phone"></i> {{ $groomer->home_phone }} <br>
                    <i class="fa fa-mobile-phone"></i> {{ $groomer->mobile_phone }} <br>
                    <i class="fa fa-mobile-phone"></i> {{ $groomer->work_phone }}
                </p>
            </div>
            <div class="col-md-9 col-sm-8">
                <div class="tab-content" style="background-color: #ffffff; padding: 0px; margin: 0px -15px;">
                    <div id="Groomer-detail" class="tab-pane fade in active">
                        <form action="{{route('edit-groomer')}}" method="POST" enctype="multipart/form-data"
                              class="form-horizontal">
                            {{ csrf_field()}}
                            <input type="hidden" name="groomer_id" value="{{ $groomer->id }}">
                            <div class="panel panel-default" style="margin-bottom: 0px;">
                                <div class="panel-heading" style="border: 0px;">
                                    <h1 class="lighter-text">{{ $groomer->first_name }}
                                        &nbsp;{{ $groomer->last_name }}</h1>
                                    <div class="btn-group">
                                        <a href="{{route('create')}}" class="btn btn-primary btn-sm" id="navLeft"
                                           title="New Groomer"><i class="fa fa-plus"></i></a>
                                        <button type="button" class="btn btn-primary btn-sm md-trigger" id="btnAlert"
                                                title="Edit Alert"><i class=" fa fa-bell"></i></button>
                                        <button type="submit" class="btn btn-primary btn-sm" id="openerCal"
                                                title="Save Groomer"><i class="fa fa-save"></i> Save
                                        </button>
                                        <a href="{{route('search')}}" class="btn btn-primary btn-sm delete-groomer"
                                           id="navRight" title="Delete Groomer" data-id="{{$groomer->id}}"
                                           data-token="{{ csrf_token() }}"><i class="fa fa-trash-o"></i></a>
                                        <button type="button" class="btn btn-primary btn-sm" id="printGroomerRecord"
                                                title="Print Groomer"><i class="fa fa-print"></i></button>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 15px 0px 0px;">
                                    <ul class="nav nav-tabs" style="background-color: #F6F6F6;">
                                        <li class="active"><a data-toggle="tab" href="#details"><i class="fa fa-user"
                                                                                                   aria-hidden="true"></i>&nbsp;Details</a>
                                        </li>
                                        <li><a data-toggle="tab" href="#notes"><i class="fa fa-file-o"
                                                                                  aria-hidden="true"></i>&nbsp;Notes</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content"
                                         style="border: 1px solid #ddd; border-top: 0px; padding: 0px 15px;">
                                        <div id="details" class="tab-pane fade in active">
                                            <br/><br/>
                                            <div class="form-group">
                                                <label for="first-name" class="col-md-2 col-sm-3 control-label">First
                                                    name:</label>
                                                <div class="col-md-10 col-sm-9">
                                                    <input type="text" class="form-control" id="first-name"
                                                           name="first_name" value="{{ $groomer->first_name }}"
                                                           required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="last-name" class="col-md-2 col-sm-3 control-label">Last
                                                    name:</label>
                                                <div class="col-md-10 col-sm-9">
                                                    <input type="text" class="form-control" id="last-name"
                                                           name="last_name" value="{{ $groomer->last_name }}" required/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="home-tel" class="col-md-2 col-sm-3 control-label">Home
                                                    Tel:</label>
                                                <div class="col-md-10 col-sm-9">
                                                    <input type="text" class="form-control" id="home-tel"
                                                           name="home_phone" value="{{ $groomer->home_phone }}"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile-tel" class="col-md-2 col-sm-3 control-label">Mobile
                                                    Tel:</label>
                                                <div class="col-md-10 col-sm-9">
                                                    <input type="text" class="form-control" id="mobile-tel"
                                                           name="mobile_phone" value="{{ $groomer->mobile_phone }}"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="work-tel" class="col-md-2 col-sm-3 control-label">Work
                                                    Tel:</label>
                                                <div class="col-md-10 col-sm-9">
                                                    <input type="text" class="form-control" id="work-tel"
                                                           name="work_phone" value="{{ $groomer->work_phone }}"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="email"
                                                       class="col-md-2 col-sm-3 control-label">Email:</label>
                                                <div class="col-md-10 col-sm-9">
                                                    <input type="text" class="form-control" id="email" name="email"
                                                           value="{{ $groomer->email }}"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="address1"
                                                       class="col-md-2 col-sm-3 control-label">Address:</label>
                                                <div class="col-md-10 col-sm-9">
                                                    <input type="text" class="form-control" id="address" name="address"
                                                           value="{{ $groomer->address }}"
                                                           style="margin-bottom: 15px;"/>
                                                    <input type="text" class="form-control" id="address2"
                                                           name="address2" value="{{ $groomer->address2 }}"
                                                           style="margin-bottom: 15px;"/>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="town" class="col-md-2 col-sm-3 control-label">Town:</label>
                                                <div class="col-md-10 col-sm-9">
                                                    <input type="text" class="form-control" id="town" name="town"
                                                           value="{{ $groomer->town }}"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="country-state" class="col-md-2 col-sm-3 control-label">Country\State:</label>
                                                <div class="col-md-10 col-sm-9">
                                                    <input type="text" class="form-control" id="country-state"
                                                           name="country_state" value="{{ $groomer->country_state }}"/>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="post-zip-code" class="col-md-2 col-sm-3 control-label">Post\Zip
                                                    code:</label>
                                                <div class="col-md-10 col-sm-9">
                                                    <input type="text" class="form-control" id="post-zip-code"
                                                           name="post_zip_code" value="{{ $groomer->home_phone }}"/value="{{ $groomer->post_zip_code }}
                                                    ">
                                                </div>
                                            </div>
                                        </div>
                                        <div id="notes" class="tab-pane fade">
                                            <br/><br/>
                                            <div class="form-group">
                                                <label for="notes"
                                                       class="col-md-2 col-sm-3 control-label">Notes:</label>
                                                <div class="col-md-10 col-sm-9">
                                                    <textarea class="form-control" id="notes" name="notes"
                                                              rows="8">{{ $groomer->note }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop