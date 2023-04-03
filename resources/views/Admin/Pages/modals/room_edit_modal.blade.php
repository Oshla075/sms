<div class="modal fade" id="modal-block-fadein{{ $key }}" tabindex="-1" role="dialog"
    aria-labelledby="modal-block-fadein" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit Room No. {{ $item->r_no }}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form method="post" action="{{ route('admin.room.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="update_id" value="{{ $item->id }}">
                            <label class="form-label">Room No.</label>
                            <input type="number" name="update_r_no" class="form-control" id="r_no"
                                placeholder="Enter Room No." aria-describedby="emailHelp" value="{{ $item->r_no }}">
                            <span id="r_no_msg" class="text-danger"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Room Capacity</label>
                            <input type="number" name="update_r_capacity" class="form-control" id="update_r_capacity"
                                placeholder="Enter Room Capacity" aria-describedby="emailHelp" value="{{ $item->r_capacity }}">
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
