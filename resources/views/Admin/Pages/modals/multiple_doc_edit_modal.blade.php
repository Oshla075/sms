<div class="modal fade" id="mul_doc_edit_modal{{$id}}" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <span class="block-title fs-lg">Edit {{$name}}'s Documents</span>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <div class="form-group bmd-form-group is-filled">
                        <div class="card p-2 mb-2">
                            <form method="post" action="{{route('edit_multi_docs')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input type="hidden" name="update_g_id" value="{{$id}}">
                                    <input type="hidden" name="update_table" value="{{$table}}">
                                    <input type="hidden" name="find_field" value="{{$find_field}}">
                                    <input type="hidden" name="update_field" value="{{$update_field}}">
                                    <input type="hidden" name="des_f" value="{{$des_f}}">
                                    <label class="form-label">Upload Documents</label>
                                    <input type="file" class="form-control" name="update_g_doc[]" id="update_g_doc"
                                        multiple>
                                </div>
                                <div class="text-center">
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
</div>
