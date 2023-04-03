@extends('Admin.Layout.main')

@section('title')
<title>Add Guardian</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
@endsection
<style>
    .heading {
        font-family: 'Roboto Slab', serif !important;
        font-weight: 600;
    }
</style>
@section('main_section')
@php
    $type = 'parents';
    $table = 'guardians';
    $find_field = 'g_id';
    $update_field = 'g_photo';
@endphp
<div class="container">
    <h1 class="text-center heading">Add Guardian</h1>
    <div class="row">
        <div class="col-4">
            <div class="card p-4">
                <form method="post" action="{{route('admin.guardian.create')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label" for="id_type">ID Type</label>
                        <select class="js-select2 form-select" id="id_type" name="id_type" style="width: 100%;"
                            data-placeholder="Choose one.." onchange="id_reset(event);">
                            <option></option>
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
                                placeholder="Enter Guardian's Name." aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guardian Gender</label>
                            <div class="space-x-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="example-radios-inline1"
                                        name="g_gender" value="Male" checked required>
                                    <label class="form-check-label" for="example-radios-inline1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="example-radios-inline2"
                                        name="g_gender" value="Female" required>
                                    <label class="form-check-label" for="example-radios-inline2">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" id="example-radios-inline3"
                                        name="g_gender" value="Others" required>
                                    <label class="form-check-label" for="example-radios-inline3">Others</label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guardian's Address</label>
                            <textarea rows="3" placeholder="Enter Guardian's Address" name="g_add" class="form-control"
                                id="g_add" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Post Office</label>
                            <input type="text" name="g_post_office" class="form-control" id="g_post_office"
                                placeholder="Enter Post Office" aria-describedby="emailHelp" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">PIN Code</label>
                            <input type="number" name="g_pin" class="form-control" id="g_pin"
                                placeholder="Enter PIN Code." aria-describedby="emailHelp" onchange="pin_chk(this);"
                                onkeypress="limitKeypress(event,this.value,6)" required>
                            <span class="text-danger" id="pin_sts"></span>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guardian's Contact No.</label>
                            <input type="number" required name="g_contact1" class="form-control" maxlength="10" id="g_contact1"
                                placeholder="Enter Guardian's Contact No." aria-describedby="emailHelp"
                                onkeypress="limitKeypress(event,this.value,10)">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guardian's Alternate Contact No.</label>
                            <input type="number" name="g_contact2" class="form-control" maxlength="10" id="g_contact2"
                                placeholder="Enter Guardian's Alternate Contact No." aria-describedby="emailHelp"
                                onkeypress="limitKeypress(event,this.value,10)">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Guardian's Photo</label>
                            <input type="file" class="form-control" name="g_photo" id="g_photo">
                            <div class="mt-2">
                                @if ($errors->has('g_photo'))
                                <span class="text-danger fw-semibold fs-sm">{{$errors->first('g_photo')}}</span>
                                @else
                                <span class="text-info fw-semibold fs-sm">Only JPG, PNG and JPEG formats are allowed.<br>File size must be in 20 KB.</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Guardian's Documents</label>
                            <input type="file" class="form-control" name="g_doc[]" id="g_doc" multiple>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-8">
            @if (sizeof($g)==0)
            <div class="card">
                <div class="card-header">
                    <div class="card-title mt-4">
                        <h1 class="text-danger text-center">No Records Found</h1>
                    </div>
                </div>
            </div>
            @else
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                                <tr>
                                    <th style="width: 20%;" class="text-center">Photo</th>
                                    <th style="width: 30%;" class="text-center">Guardian Name</th>
                                    <th style="width: 25%;" class="text-center">Guardian Address</th>
                                    <th class="text-center" style="width: 30%;">Guardian Contact No.</th>
                                    <th class="text-center" style="width: 30%;">Guardian Aadhaar No.</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($g as $key => $item)
                                <tr>
                                    <td class="text-center">
                                        @php
                                            $g_id = $item->g_id;
                                        @endphp
                                        @if ($item->g_photo == null)
                                        <button type="button" class="btn btn-sm btn-alt-secondary"
                                        data-bs-toggle="modal" data-bs-target="#g_edit_modal{{ $g_id }}" title="Edit Image">
                                             <img src="{{url('/')}}/assets/media/avatars/avatar13.jpg" alt="" class="img-avatar img-avatar-thumb">
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-sm btn-alt-secondary"
                                        data-bs-toggle="modal" data-bs-target="#g_edit_modal{{ $g_id }}" title="Edit Image">
                                             <img src="{{url('/storage')}}/parents/{{$item->g_id}}/{{$item->g_photo}}" alt="" class="img-avatar img-avatar-thumb">
                                        </button>
                                        @endif
                                        @include('Admin.Pages.modals.g_photo_edit_modal')
                                    </td>
                                    <td class="fw-semibold fs-sm text-center">
                                        <a href="#">{{ $item->g_name}}</a>
                                    </td>
                                    <td class="text-center">{{ $item->g_address}}</td>
                                    <td class="text-center">{{ $item->g_contact_1}}</td>
                                    <td class="text-center">{{ $item->adh_no}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{url('admin/guardian/edit/')}}/{{$item->g_id}}/" class="btn btn-sm btn-alt-success"><i class="fa fa-fw fa-pencil-alt"></i>&nbsp;Edit</a>&nbsp;
                                            {{-- <a href="{{url('admin/guardian/delete/')}}/{{$item->g_id}}/" class="btn btn-sm btn-alt-danger" onclick="return confirm('Are you sure you want to delete this Guardian?')"><i class="fa fa-fw fa-trash"></i>&nbsp;Delete</a> --}}
                                            <button onclick="delguardian(this);" class="btn btn-danger btn-sm" id="{{$item->g_id}}"><i class="fa fa-fw fa-trash"></i>&nbsp;Delete</button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script src="{{ url('/') }}/assets/js/lib/jquery2.min.js"></script>
<script>
    $(document).ready(function() {
            $('#other').hide();
        });

        function id_reset(e) {
            e.preventDefault();

            $('#g_card_no').val('');
            $('#other').hide();
            $('#id_card_sts').html('');
        }

        function adr_chk(event) {

            var x = $('#id_type option:selected').val();
            var len;
            if(x == 'voterid')
            {
                len = 10;
            }
            else if(x == 'aadhaar')
            {
                len = 12;
            }
            else if(x == 'pan')
            {
                len = 10;
            }

            var c = $('#g_card_no').val().trim();
            var fd={
                'g_v_doc':x,
                'adh_no':c
            };
            var url = "{{ route('admin.chk_any2') }}";
            if(c.length == len)
                {
                    $('#id_card_sts').html('');
                    $.ajax({
                    type: "get",
                    url: url,
                    data: {
                        'f_n': JSON.stringify(fd),
                        't_n': 'guardians',
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        if (response == 0) {
                            $('#other').show();

                        } else {
                            $('#id_card_sts').html(x+' No. Already Exists!');
                            $('#other').hide();
                        }
                    }
                });
                }
                else if(c.length == 0)
                {
                    $('#id_card_sts').html('');
                    $('#other').hide();
                }
                else
                {
                    $('#id_card_sts').html(x+' must be '+len+' digits.<br>You have entered '+c.length+' digits.');
                    $('#other').hide();
                }
        }

        function pin_chk(event) {
            var p = $('#g_pin').val();
            if(p.length == 0)
            {
                $('#pin_sts').html('');
            }
            else
            {
                if(p.length < 6)
                {
                $('#pin_sts').html('PIN Code must be 6 digits.<br>You have entered '+p.length+' digits.');
                }
                else
                {
                $('#pin_sts').html('');
                }
            }
        }

        function delguardian(sel,id) {
        var id = $(sel).attr('id');


        Swal.fire({
        title: 'Are you sure you want to Delete this Guardian?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
            title: 'Provide Password to Delete Record',
            html: `<input type="password" id="password" class="swal2-input" placeholder="Password">`,
            confirmButtonText: 'Proceed',
            focusConfirm: false,
            showCancelButton: true,
            preConfirm: () => {
            const password = Swal.getPopup().querySelector('#password').value
            if (password != '123') {
            Swal.showValidationMessage(`Please enter a valid password`)
            }
            return {password: password }
            }
            }).then((result) => {
            if (result.isConfirmed){
            $.ajax({
            type: "get",
            url: "{{route('admin.guardian.delete')}}",
            data: {
            'id':id
            },
            dataType: "JSON",
            success: function (response) {
            Swal.fire(
            'Deleted!',
            'Guardian Record Deleted Successfully',
            'success'
            )
            window.location.reload();
            }
            });
            }
            })
        }
        })
        }
</script>
@endsection
