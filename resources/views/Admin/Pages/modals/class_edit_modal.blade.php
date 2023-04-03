<div class="modal fade" id="modal-block-fadein{{ $key }}" tabindex="-1" role="dialog"
    aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit Class Name {{ $item->c_name }}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form method="post" action="{{route('admin.class.update')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="update_id" value="{{ $item->id }}">
                            <label class="form-label">Edit Class Name</label>
                            <input type="text" name="update_c_name" class="form-control" id="c_name"
                                placeholder="Enter Class Name" aria-describedby="emailHelp" value="{{ $item->c_name }}">
                            <span id="c_name_msg" class="text-danger"></span>
                        </div>
                        <div class="text-center mb-3">
                            <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary" data-bs-dismiss="modal">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
