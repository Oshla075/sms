<div class="modal fade" id="sectionModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit Section Name {{$item->s_name }} of class {{$item->c_name}}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <div class="form-group bmd-form-group is-filled">
                        <form method="post" action="{{route('admin.section.update')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="update_id" value="{{ $item->id }}">
                                <label class="form-label">Section Name</label>
                                <input type="text" name="update_sec_name" class="form-control" id="update_sec_name"
                                    placeholder="Enter Section Name" aria-describedby="emailHelp"
                                    value="{{$item->s_name}}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="sec_class{{$item->id}}">Class</label>
                                <select class="js-select2 form-select" id="update_sec_class{{$item->id}}"
                                    name="update_sec_class" style="width: 100%;" data-placeholder="Choose one..">
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach ($y as $key => $item2)
                                    <option value="{{ $item2->id }}" {{ $item->c_id == $item2->id ? 'selected' : ''}}
                                        >{{ $item2->c_name}}</option>
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
