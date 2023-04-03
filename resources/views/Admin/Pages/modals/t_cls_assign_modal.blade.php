<div class="modal fade" id="t_cls_modal{{ $key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Assign Class and Section for {{$item->t_name}}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <div class="form-group bmd-form-group is-filled">
                        <form method="post" action="{{route('admin.assign_cls_teacher')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="t_id" value="{{$item->tea_id}}">
                            <div class="mb-4">
                                <label class="form-label" for="t_sec_assign{{$key}}">Choose Class and Section</label>
                                <select class="js-select2 form-select" id="t_sec_assign{{$key}}"
                                    name="t_sec_assign" style="width: 100%;" data-placeholder="Choose one..">
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach ($sections as $key => $item2)
                                    <option value="{{ $item2->id }}">{{ $item2->c_name}} - {{ $item2->s_name}}</option>
                                    @endforeach
                                </select>
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
