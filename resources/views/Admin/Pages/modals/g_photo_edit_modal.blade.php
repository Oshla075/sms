<div class="modal fade" id="g_edit_modal{{$g_id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <span class="block-title fs-lg">Edit Image</span>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <div class="form-group bmd-form-group is-filled">
                        <form method="post" action="{{route('insert_image')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="update_g_id" value="{{ $g_id }}">
                                <input type="hidden" name="update_type" value="{{$type}}">
                                <input type="hidden" name="update_table" value="{{$table}}">
                                <input type="hidden" name="find_field" value="{{$find_field}}">
                                <input type="hidden" name="update_field" value="{{$update_field}}">
                            </div>
                            <div class="mb-3">
                            <label class="form-label">Upload {{$type}}' Photo</label>
                            <input type="file" class="form-control" name="updated_g_photo" id="updated_g_photo">
                                <div class="mt-2">
                                    @if ($errors->has('updated_g_photo'))
                                    <span class="text-danger fw-semibold fs-sm">{{$errors->first('updated_g_photo')}}</span>
                                    @else
                                    <span class="text-info fw-semibold fs-sm">Only JPG, PNG and JPEG formats are allowed.<br>File size must be in 20 KB.</span>
                                    @endif
                                </div>
                            </div>
                            <div class="text-center mb-3">
                                <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-sm btn-success"
                                    data-bs-dismiss="modal">Edit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
