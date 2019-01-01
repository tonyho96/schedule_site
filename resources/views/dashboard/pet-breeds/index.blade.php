@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 style="background-color: #ffffff; margin: -15px -15px 0px -15px; padding: 15px 20px;"><i class="fa fa-paw"
                                                                                                 aria-hidden="true"></i>&nbsp;Pet
        Breed</h1>
    <ol class="breadcrumb">
        <li><a href="/">Home</a></li>
        <li class="active">Pet Breeds</li>
    </ol>
@stop

@section('css')
    <style>
        .form-group.item {
            padding-bottom: 30px;
        }
    </style>
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
        <button type="button" class="btn btn-success md-trigger" title="New Breed" data-toggle="modal"
                data-target="#newBreedModal" id="btnBreed"><i class="fa fa-plus"></i> New breed
        </button>
        <p><i>By default pet breeds are filtered by breed name 'A', please click on a letter to change your filter.</i>
        </p>
        <p>If your business charges based upon pet breed then please enter a price, i.e "Border Collie", "Dog",
            "30.00"</p>

        <hr>

        <div class="search-breed ln-letters">
            <a class="search-by-key" data-key="all" href="#">ALL</a>
            <a class="search-by-key" data-key="0_9" href="#">0-9</a>
            <a class="search-by-key ln-selected" data-key="a" href="#">A</a>
            @foreach(range('B', 'Z') as $char)
                <a class="search-by-key" data-key="{{ strtolower($char) }}" href="#">{{ $char }}</a>
            @endforeach
            <a class="" data-key="" href="#">...</a>
        </div>
        <div class="content">
            <div class="list-group">
                <div style="padding-bottom: 55px;"></div>
                <div id="dynamic-content">
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="newBreedModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="color-background-info modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title"><i class="fa fa-paw"></i>&nbsp;Add New Breed</h3>
                </div>
                <div class="modal-body">
                    <div id="appPlaceholder">
                        <form action="{{ action('Dashboard\PetBreedController@store') }}" method="post"
                              id="form-create-or-edit">
                            {!! csrf_field() !!}
                            <div class="container-fluid">
                                <div class="form-group">
                                    <label for="create-breed-name" class="col-sm-3 control-label">Name:</label>
                                    <div class="col-sm-7">
                                        <input id="create-breed-name" class="form-control" name="name"
                                               required="required">
                                    </div>
                                </div>

                                <p style="padding-top: 2em; text-align: right;">
                                    <button id="create-breed-btn" type="submit" value="button" class="btn btn-info">
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        function updateBreedList(key) {
            $.get('{{ action('Dashboard\PetBreedController@ajaxSearchByKey') }}' + '?key=' + key, function (response) {
                $('#dynamic-content').html(response);
            });
        }

        updateBreedList('a');

        $('.search-breed.ln-letters a').click(function (e) {
            e.preventDefault();
            $('.search-breed.ln-letters a').removeClass('ln-selected');
            $(this).addClass('ln-selected');

            var key = $(this).data('key');
            updateBreedList(key);
        });

        $('body').on('click', '.delete-breed-btn', function (e) {
            e.preventDefault();

            var confirm = window.confirm('Are you sure?');
            if (!confirm)
                return false;

            var thisComponent = $(this);
            thisComponent.attr('disabled', 'disabled');
            var id = thisComponent.closest('.item').data('id');

            var url = '/dashboard/petbreed/ajax-delete/' + id;
            $.get(url, function (response) {
                if (response.status === 1) {
                    thisComponent.closest('.item').remove();
                }
                else {
                    alert(response.message);
                    thisComponent.removeAttr('disabled');
                }
            }, 'json');
        })

        $('body').on('click', '.update-breed-btn', function (e) {
            e.preventDefault();

            var confirm = window.confirm('Are you sure?');
            if (!confirm)
                return false;

            var thisComponent = $(this);
            thisComponent.attr('disabled', 'disabled');
            var id = thisComponent.closest('.item').data('id');
            var name = thisComponent.closest('.item').find('input.name').val();

            var url = '/dashboard/petbreed/ajax-update/' + id;
            var data = {
                name: name,
                "_token": "{{ csrf_token() }}"
            };
            $.post(url, data, function (response) {
                if (response.status === 1) {
                    thisComponent.removeAttr('disabled');
                }
                else {
                    alert(response.message);
                    thisComponent.removeAttr('disabled');
                }
            }, 'json');
        })
    </script>
@stop