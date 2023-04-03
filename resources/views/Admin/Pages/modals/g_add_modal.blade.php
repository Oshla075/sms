<div class="modal fade" id="g_add_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Guardian</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <div class="form-group bmd-form-group is-filled">
                        <form method="post" action="{{route('admin.guardian.create')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label" for="id_type">ID Type</label>
                                <select class="js-select2 form-select" id="id_type" name="id_type" style="width: 100%;"
                                    data-placeholder="Choose one.." onchange="id_reset(event);">
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    <option value="voterid">Voter ID</option>
                                    <option value="aadhaar">Aadhaar Card</option>
                                    <option value="pan">PAN</option>
                                </select>
                            </div>
                            {{-- <div class="mb-3" id="g_voter">
                                <label class="form-label">Guardian Voter ID No.</label>
                                <input type="number" onchange="adr_chk(this); name="g_card_no" class="form-control" id="g_card_no" onkeypress="limitKeypress(event,this.value,10)"
                                    placeholder="Enter Guardian's Aadhaar No." aria-describedby="emailHelp"
                                    >
                                <span id="id_card_sts" class="text-danger"></span>
                            </div> --}}
                            <div class="mb-3" id="g_adh">
                                <label class="form-label">Guardian Aadhaar No.</label>
                                <input type="number" onchange="adr_chk(this);" name="g_card_no" class="form-control" id="g_card_no"
                                    placeholder="Enter Guardian's Aadhaar No." aria-describedby="emailHelp"
                                     onkeypress="limitKeypress(event,this.value,12)">
                                <span id="id_card_sts" class="text-danger"></span>
                            </div>
                            {{-- <input type="number" class="form-control" onkeypress="limitKeypress(event,this.value,10)"> --}}
                            {{-- <div class="mb-3" id="g_pan">
                                <label class="form-label">Guardian PAN No.</label>
                                <input type="number" name="g_card_no" class="form-control" id="g_card_no" onkeypress="limitKeypress(event,this.value,10)"
                                    placeholder="Enter Guardian's Aadhaar No." aria-describedby="emailHelp"
                                    >
                                <span id="id_card_sts" class="text-danger"></span>
                            </div> --}}
                            <div id="other">
                                <div class="mb-3">
                                    <label class="form-label">Name of the Guardian</label>
                                    <input type="text" name="g_name" class="form-control" id="g_name"
                                        placeholder="Enter Guardian's Name." aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Guardian Gender</label>
                                    <div class="space-x-6">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="example-radios-inline1"
                                                name="g_gender" value="Male" checked>
                                            <label class="form-check-label" for="example-radios-inline1">Male</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="example-radios-inline2"
                                                name="g_gender" value="Female">
                                            <label class="form-check-label" for="example-radios-inline2">Female</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" id="example-radios-inline3"
                                                name="g_gender" value="Others">
                                            <label class="form-check-label" for="example-radios-inline3">Others</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Guardian's Address</label>
                                    <textarea rows="3" placeholder="Enter Guardian's Address" name="g_add" class="form-control"
                                        id="g_add"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Post Office</label>
                                    <input type="text" name="g_post_office" class="form-control" id="g_post_office"
                                        placeholder="Enter Post Office" aria-describedby="emailHelp">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">PIN Code</label>
                                    <input type="number" name="g_pin" class="form-control" id="g_pin"
                                        placeholder="Enter PIN Code." aria-describedby="emailHelp" onchange="pin_chk(this);"
                                        onkeypress="limitKeypress(event,this.value,6)">
                                    <span class="text-danger" id="pin_sts"></span>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Guardian's Contact No.</label>
                                    <input type="number" name="g_contact1" class="form-control" maxlength="10" id="g_contact1"
                                        placeholder="Enter Guardian's Contact No." aria-describedby="emailHelp"
                                        onkeypress="limitKeypress(event,this.value,10)"><br>
                                    <label class="form-label">Guardian's Alternate Contact No.</label>
                                    <input type="number" name="g_contact2" class="form-control" maxlength="10" id="g_contact2"
                                        placeholder="Enter Guardian's Alternate Contact No." aria-describedby="emailHelp"
                                        onkeypress="limitKeypress(event,this.value,10)">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Upload Guardian's Photo</label>
                                    <input type="file" class="form-control" name="g_photo" id="g_photo">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                    <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
