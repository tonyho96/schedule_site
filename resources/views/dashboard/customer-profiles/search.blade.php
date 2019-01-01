@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
    <h1 style="background-color: #ffffff; margin: -15px -15px 0px -15px; padding: 15px 20px;"><i class="fa fa-user"></i>
        Search Customer</h1>
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li class="active">customers</li>
    </ol>
@stop
@section('content')
    <div class="container-fluid" style="background-color: #ffffff; padding: 15px; border: 1px solid #ddd;">
        <div class="block-flat">
            <div class="header">
                <div class="input-group">
                    <input type="text" placeholder="Search for client by last name, address or mobile number..."
                           class="form-control ui-autocomplete-input" id="ClientName" autocomplete="off">
                    <span class="input-group-btn">
					<button class="btn btn-primary" type="button" id="btnsearchCustomer"><i
                                class="fa fa-search"></i></button>
				</span>
                </div>
                <div class="spacer spacer-bottom">
                    <a href="{{route('create')}}" class="btn btn-success" title="New client"><i class="fa fa-plus"></i>
                        New customer</a>
                </div>
            </div>
            <i>By default customers are filtered by Last name 'A', please click on a letter to change your filter.</i>

            <div id="demoFour-nav">
                <div class="search-customer ln-letters"><a class="all" href="#">ALL</a><a class="_" href="#">0-9</a><a
                            class="a" href="#">A</a><a class="b" href="#">B</a><a class="c" href="#">C</a><a class="d"
                                                                                                             href="#">D</a><a
                            class="e" href="#">E</a><a class="f" href="#">F</a><a class="g" href="#">G</a><a class="h"
                                                                                                             href="#">H</a><a
                            class="i" href="#">I</a><a class="j" href="#">J</a><a class="k" href="#">K</a><a class="l"
                                                                                                             href="#">L</a><a
                            class="m" href="#">M</a><a class="n" href="#">N</a><a class="o" href="#">O</a><a class="p"
                                                                                                             href="#">P</a><a
                            class="q" href="#">Q</a><a class="r" href="#">R</a><a class="s" href="#">S</a><a class="t"
                                                                                                             href="#">T</a><a
                            class="u" href="#">U</a><a class="v" href="#">V</a><a class="w" href="#">W</a><a class="x"
                                                                                                             href="#">X</a><a
                            class="y" href="#">Y</a><a class="z" href="#">Z</a><a class="- ln-last" href="#">...</a>
                </div>
            </div>
            <div class="content">
                <div class="list-group">
                    <div style="padding-bottom: 55px;"></div>
                    <div id="demoFour">
                        <li class="ln-no-match" style="">No results to display, try selecting another letter?</li>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop