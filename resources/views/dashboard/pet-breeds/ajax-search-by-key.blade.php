@if (empty($breeds))
    <li class="ln-no-match" style="">No results to display, try selecting another letter?</li>
@else
    @foreach($breeds as $breed)
        <div class="form-group item" data-id="{{ $breed->id }}">
            <div class="col-sm-10">
                <input type="text" value="{{ $breed->name }}" class="form-control valid name">
            </div>
            <div class="col-sm-1">
                <button class="btn btn-small btn-primary btn-flat update-breed-btn" type="button">
                    <i class="fa fa-save" title="Edit"></i>
                </button>
            </div>
            <div class="col-sm-1">
                <button class="btn btn-small btn-danger btn-flat delete-breed-btn" type="button">
                    <i class="fa fa-times" title="Delete"></i>
                </button>
            </div>
        </div>
    @endforeach
@endif