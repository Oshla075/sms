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
<div class="container">
    <h1 class="text-center heading">Add Guardian</h1>
    <div class="row">
        <div class="col-6">
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
                    <div class="mb-3" id="g_voter">
                        <label class="form-label">Guardian Voter ID No.</label>
                        <input type="number" name="g_card_no" class="form-control" id="g_card_no" onkeypress="limitKeypress(event,this.value,10)"
                            placeholder="Enter Guardian's Aadhaar No." aria-describedby="emailHelp"
                            >
                        <span id="id_card_sts" class="text-danger"></span>
                    </div>
                    <div class="mb-3" id="g_adh">
                        <label class="form-label">Guardian Aadhaar No.</label>
                        <input type="number" name="g_card_no" class="form-control" id="g_card_no"
                            placeholder="Enter Guardian's Aadhaar No." aria-describedby="emailHelp"
                             onkeypress="limitKeypress(event,this.value,12)">
                        <span id="id_card_sts" class="text-danger"></span>
                    </div>
                    {{-- <input type="number" class="form-control" onkeypress="limitKeypress(event,this.value,10)"> --}}
                    <div class="mb-3" id="g_pan">
                        <label class="form-label">Guardian PAN No.</label>
                        <input type="number" name="g_card_no" class="form-control" id="g_card_no" onkeypress="limitKeypress(event,this.value,10)"
                            placeholder="Enter Guardian's Aadhaar No." aria-describedby="emailHelp"
                            >
                        <span id="id_card_sts" class="text-danger"></span>
                    </div>
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
        <div class="col-6">
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
                                    <th style="width: 20%;" class="text-center">Sl. No.</th>
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
                                    <td class="text-center">{{ ++$key }}</td>
                                    <td class="fw-semibold fs-sm text-center">
                                        <a href="#">{{ $item->g_name}}</a>
                                    </td>
                                    <td class="text-center">{{ $item->g_address}}</td>
                                    <td class="text-center">{{ $item->g_contact_1}}</td>
                                    <td class="text-center">{{ $item->adh_no}}</td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="modal" data-bs-target="#" title="Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
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
            $('#g_voter').hide();
            $('#g_adh').hide();
            $('#g_pan').hide();

            // $('#other').css({'display':"block"});
            // $('#disble').prop('disabled', true);

        });

        function id_reset(e) {
            e.preventDefault();
            var x = $('#id_type option:selected').val();
            if(x == 'voterid')
            {
                $('#g_voter').show();
                // onchange="adr_chk(this);
                // $('#g_voter').prop('onchange', adr_chk(this));
                $('#g_adh').hide();
                $('#g_pan').hide();
                // len = 10;
            }
            else if(x == 'aadhaar')
            {
                $('#g_voter').hide();
            $('#g_adh').show();
            $('#g_pan').hide();
                // len = 12;

            }
            else if(x == 'pan')
            {
                $('#g_voter').hide();
            $('#g_adh').hide();
            $('#g_pan').show();
                // len = 10;

            }
            $('#g_card_no').val('');
            $('#other').hide();
            $('#id_card_sts').html('');
        }

        function adr_chk(event) {
            // event.preventDefault();
            var x = $('#id_type option:selected').val();
            var len;
            if(x == 'voterid')
            {
                // $('#g_voter').show();
                // $('#g_adh').hide();
                // $('#g_pan').hide();
                len = 10;
            }
            else if(x == 'aadhaar')
            {
                // $('#g_voter').hide();
            // $('#g_adh').show();
            // $('#g_pan').hide();
                len = 12;

            }
            else if(x == 'pan')
            {
            //     $('#g_voter').hide();
            // $('#g_adh').hide();
            // $('#g_pan').show();
                len = 10;

            }
            // console.log(x);
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
                            // $('#disble').prop('disabled', false);
                        } else {
                            $('#id_card_sts').html(x+' No. Already Exists!');
                            $('#other').hide();
                            // Swal.fire(
                            //     'Email ID Already Exists!',
                            //     '',
                            //     'warning'
                            // )
                            // $('#disble').prop('disabled', true);
                        }
                    }
                });
                }
                else
                {
                    $('#id_card_sts').html(x+' must be '+len+' digits.<br>You have entered '+c.length+' digits.');
                    $('#other').hide();
                }

            // if(c.length == 0)
            // {
            //     $('#other').hide();
            //     $('#id_card_sts').html('');

            // }
            // else
            // {
            //     if(c.length == 12)
            //     {
            //         $('#id_card_sts').html('');
            //         $.ajax({
            //         type: "get",
            //         url: url,
            //         data: {
            //             'f_n': JSON.stringify(fd),
            //             't_n': 'guardians',
            //         },
            //         dataType: "JSON",
            //         success: function(response) {
            //             console.log(response);
            //             if (response == 0) {
            //                 $('#other').show();
            //                 // $('#disble').prop('disabled', false);
            //             } else {
            //                 $('#id_card_sts').html('Aadhar No. Already Exists!');
            //                 $('#other').hide();
            //                 // Swal.fire(
            //                 //     'Email ID Already Exists!',
            //                 //     '',
            //                 //     'warning'
            //                 // )
            //                 // $('#disble').prop('disabled', true);
            //             }
            //         }
            //     });
            //     }
            //     else
            //     {
            //         $('#id_card_sts').html('Aadhar No. must be 12 digits.<br>You have entered '+c.length+' digits.');
            //         $('#other').hide();
            //     }
            // }
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
        // function cont_no(sel,e) {
        //     e.preventDefault();
        //     console.log(sel.value);
        // }

</script>
@endsection
