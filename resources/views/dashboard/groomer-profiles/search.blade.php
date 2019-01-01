@extends('adminlte::page')
@section('title', 'AdminLTE')
@section('content_header')
    <h1 style="background-color: #ffffff; margin: -15px -15px 0px -15px; padding: 15px 20px;"><i class="fa fa-user"></i>
        Search Groomer</h1>
@stop
@section('content')
    <div class="container-fluid" style="background-color: #ffffff; padding: 15px; border: 1px solid #ddd;">
        <div class="spacer spacer-bottom">
            <a href="{{route('create-groomer')}}" class="btn btn-success" title="New client"><i class="fa fa-plus"></i>
                New groomer</a>
        </div>
        <table id="groomer-list" class="display" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach ($groomers as $groomer)
                <tr>
                    <td>{{ $groomer->first_name }}</td>
                    <td>{{ $groomer->last_name }}</td>
                    <td>{{ $groomer->email }}</td>
                    <td>
                        <a href="{{route('detail', ['id' => $groomer->id])}}" class="btn btn-primary">Edit</a>
                        <a href="{{route('search')}}" class="btn btn-danger delete-groomer" data-id="{{$groomer->id}}"
                           data-token="{{ csrf_token() }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@stop