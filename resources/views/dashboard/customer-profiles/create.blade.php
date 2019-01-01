@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="background-color: #ffffff; margin: -15px -15px 0px -15px; padding: 15px 20px;"><i class="fa fa-user"
                                                                                                 aria-hidden="true"></i>&nbsp;New
        Client</h1>
@stop

@section('content')
    @if ($errors->has('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{$errors->first('error')}}
        </div>
    @endif
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="container-fluid" style="background-color: #ffffff; padding: 15px; border: 1px solid #ddd;">
        <form action="{{ route('savecustomer') }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-floppy-o" aria-hidden="true"></i>
                        Save&nbsp;&amp;&nbsp;Pets
                    </button>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#details"><i class="fa fa-user"
                                                                                   aria-hidden="true"></i>&nbsp;Details</a>
                        </li>
                        <li><a data-toggle="tab" href="#notes"><i class="fa fa-file-o" aria-hidden="true"></i>&nbsp;Notes</a>
                        </li>
                    </ul>

                    <div class="tab-content" style="border: 1px solid #ddd; border-top: 0px; padding: 0px 15px;">

                        <div id="details" class="tab-pane fade in active">
                            <br/><br/>
                            <div class="form-group">
                                <label for="first-name" class="col-sm-2 control-label">First name:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="first-name" name="first_name" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="last-name" class="col-sm-2 control-label">Last name:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="last-name" name="last_name" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="home-tel" class="col-sm-2 control-label">Home Tel:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="home-tel" name="home_phone"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="mobile-tel" class="col-sm-2 control-label">Mobile Tel:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="mobile-tel" name="mobile_phone" required/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="work-tel" class="col-sm-2 control-label">Work Tel:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="work-tel" name="work_phone"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">Email:</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email" name="email" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="address1" class="col-sm-2 control-label">Address:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="address" name="address"
                                           style="margin-bottom: 15px;" />
                                    <input type="text" class="form-control" id="address2" name="address2"
                                           style="margin-bottom: 15px;"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="town" class="col-sm-2 control-label">Town:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="town" name="town"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="country-state" class="col-sm-2 control-label">Country\State:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="country-state" name="country_state"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="post-zip-code" class="col-sm-2 control-label">Post\Zip code:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="post-zip-code" name="post_zip_code"/>
                                </div>
                            </div>
                        </div>

                        <div id="notes" class="tab-pane fade">
                            <br/><br/>
                            <div class="form-group">
                                <label for="notes" class="col-sm-2 control-label">Notes:</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="notes" name="notes" rows="8"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </div>
@stop