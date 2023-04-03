<div class="modal fade" id="sectionRoomModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Edit Room No. {{$item->r_no }} of Section {{$item->s_name}} Class {{$item->c_name}}</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <div class="form-group bmd-form-group is-filled">
                        <form method="post" action="{{route('admin.section.room.update')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input type="hidden" name="update_id" value="{{ $item->id }}">
                                <input type="hidden" name="update_r_id" value="{{ $item->r_id }}">
                            </div>
                            <div class="mb-4">
                                <label class="form-label" for="update_sec_room{{$item->id}}">Room</label>
                                <select class="js-select2 form-select" id="update_sec_room{{$item->id}}"
                                    name="update_sec_room" style="width: 100%;" data-placeholder="Choose one..">
                                    {{-- <option></option> --}}
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach ($x1 as $item1)
                                    <option value="{{$item1->id}}" {{ $item1->r_no == $item->r_no ? 'selected' :
                                        ''}}>{{$item1->r_no}}</option>
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
