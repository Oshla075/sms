<div class="modal fade" id="g_edit_modal{{$key}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <span class="block-title fs-lg">Edit Guardian</span>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <div class="form-group bmd-form-group is-filled">
                        <form method="post" action="{{route('admin.guardian.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="update_g_id" value="{{$item->g_id}}">
                            <div class="mb-3">
                                <label class="form-label" for="update_g_card_no">Guardian Aadhaar No.</label>
                                <input type="number" name="update_g_card_no" class="form-control" id="update_g_card_no"
                                    placeholder="Enter Guardian's Aadhaar No." aria-describedby="emailHelp"
                                     onkeypress="limitKeypress(event,this.value,12)" value="{{$item->adh_no}}">
                                {{-- <span id="id_card_sts" class="text-danger"></span> --}}
                            </div>
                            {{-- <div id="other"> --}}
                                <div class="mb-3">
                                    <label class="form-label">Name of the Guardian</label>
                                    <input type="text" name="update_g_name" class="form-control" id="update_g_name"
                                        placeholder="Enter Guardian's Name." aria-describedby="emailHelp" value="{{$item->g_name}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Guardian Gender</label>
                                    <div class="space-x-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="example1"
                                                name="update_g_gender" value="Male" {{ $item->g_gender == 'Male' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="example1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="example2"
                                                name="update_g_gender" value="Female" {{ $item->g_gender == 'Female' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="example2">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="example3"
                                                name="update_g_gender" value="Others" {{ $item->g_gender == 'Others' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="example3">Others</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Guardian's Address</label>
                                    <textarea rows="3" placeholder="Enter Guardian's Address" name="update_g_add" class="form-control"
                                        id="update_g_add">{{$item->g_address}}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Post Office</label>
                                    <input type="text" name="update_g_post_office" class="form-control" id="update_g_post_office"
                                        placeholder="Enter Post Office" aria-describedby="emailHelp" value="{{$item->g_post_office}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">PIN Code</label>
                                    <input type="number" name="update_g_pin" class="form-control" id="update_g_pin"
                                        placeholder="Enter PIN Code." aria-describedby="emailHelp"
                                        onkeypress="limitKeypress(event,this.value,6)" value="{{$item->g_pin_code}}">
                                    {{-- <span class="text-danger" id="pin_sts"></span> --}}
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Guardian's Contact No.</label>
                                    <input type="number" name="update_g_contact1" class="form-control" maxlength="10" id="update_g_contact1"
                                        placeholder="Enter Guardian's Contact No." aria-describedby="emailHelp"
                                        onkeypress="limitKeypress(event,this.value,10)" value="{{$item->g_contact_1}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Guardian's Alternate Contact No.</label>
                                    <input type="number" name="update_g_contact2" class="form-control" maxlength="10" id="update_g_contact2"
                                        placeholder="Enter Guardian's Alternate Contact No." aria-describedby="emailHelp"
                                        onkeypress="limitKeypress(event,this.value,10)" value="{{$item->g_contact_2}}">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                                </div>
                            {{-- </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
