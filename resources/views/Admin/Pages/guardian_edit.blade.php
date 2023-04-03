@extends('Admin.Layout.main')

@section('title')
<title>Edit Guardian {{$query[0]->g_name}}</title>
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

    .btn .badge {
        position: relative;
        top: -15px !important;
        left: 16px !important;
    }
</style>
@section('main_section')
@php
$table = "guardians";
$find_field = "g_id";
$update_field = "g_doc";
$id = $query[0]->g_id;
$name = $query[0]->g_name;
$des_f = 'parents';
@endphp
<div class="container">
    <h1 class="text-center heading">Edit Guardian {{$query[0]->g_name}}</h1>
    <div class="row">
        <div class="col-6">
            <div class="card mb-4 p-2">
                <div class="card-header bg-primary text-center">
                    <span class="fw-semibold fs-lg text-white">Edit Guardian ID</span><br>
                    <span class="fw-semibold fs-md text-white">Registered {{$query[0]->g_v_doc}} No.:
                        {{$query[0]->adh_no}}</span>
                </div>
                <div class="card-body">
                    <div class="form-group bmd-form-group is-filled">
                        <form method="post" action="{{route('admin.guardian.id_update')}}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="update_g_id" value="{{$query[0]->g_id}}">
                            @if($query[0]->g_v_doc == 'aadhaar')
                            <div class="mb-3">
                                <input type="hidden" name="" id="old_adh" value="{{$query[0]->adh_no}}">
                                <label class="form-label" for="update_g_card_no">Guardian Aadhaar No.</label>
                                <input type="number" name="update_g_card_no" class="form-control" id="update_g_card_no"
                                    placeholder="Enter Guardian's Aadhaar No." aria-describedby="emailHelp"
                                    onkeypress="limitKeypress(event,this.value,12)" value="{{$query[0]->adh_no}}"
                                    onchange="g_adh_chk(this);">
                                <span class="text-danger" id="update_g_adhr_sts"></span>
                            </div>
                            @else
                            <div class="mb-3">
                                <label class="form-label" for="update_g_card_no">Guardian Aadhaar No.</label>
                                <input type="number" name="update_g_card_no" class="form-control" id="update_g_card_no"
                                    placeholder="Enter Guardian's Aadhaar No." aria-describedby="emailHelp"
                                    onkeypress="limitKeypress(event,this.value,12)" value=""
                                    onchange="g_adh_chk(this);">
                                <span class="text-danger" id="update_g_adhr_sts"></span>
                            </div>
                            @endif
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg" style="margin-right: 10px;"
                                    id="g_edit_btn">Submit</button>
                                <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card mb-4 p-2">
                <div class="card-header bg-primary text-center">
                    <span class="fw-semibold fs-lg text-white">View Guardian Documents</span>
                </div>
                <div class="card-body">
                    <div class="form-group bmd-form-group is-filled">
                        <div class="mb-3">
                            @php
                            $b = array();
                            $sub = Str::substr($query[0]->g_doc,0,Str::length($query[0]->g_doc)-1);
                            $b = explode(',',$sub);
                            $d = ($b[(sizeof($b)-1)]);
                            $pos = (strrpos($d,'.')-1);
                            $sub_str = (int)substr($d,$pos,1);
                            // dd($sub_str);
                            @endphp
                            @if ($b[0]!="")
                            @foreach ($b as $key=>$item)
                            <a href="{{url('/storage')}}/parents/{{$query[0]->g_id}}/{{$item}}" target="_blank"
                                class="btn btn-primary btn-sm"
                                style="padding-right: 40px !important; margin-right: 20px;">{{++$key}}
                            </a>
                            <a href="{{url('/admin/multi_data_remove/')}}/{{$item}}/{{$query[0]->g_doc}}/{{$query[0]->g_id}}/g_id/g_doc/guardians/parents"
                                onclick="return confirm('Are you sure you want to delete this document?')"><span
                                    class="badge badge-danger"
                                    style="background-color: red !important; margin-left: -40px;"><i class="fa fa-fw fa-times"></i></span></a>
                            {{-- <img class="img-avatar img-avatar-thumb"
                                src="{{url('/storage')}}/parents/{{$query[0]->g_id}}/{{$item}}"
                                style="width: 200px !important; height: 200px !important;" alt=""> --}}
                            @endforeach
                            <div class="text-center mt-3"><button class="btn btn-success btn-lg" id="g_add_doc">Add Documents</button></div>
                            <div id="add_doc">
                                <form action="{{route('edit_multi_docs_2')}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <input type="hidden" name="tb_name" value="{{$table}}">
                                    <input type="hidden" name="search_field" value="{{$find_field}}">
                                    <input type="hidden" name="goal_field" value="{{$update_field}}">
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Add More Documents</label>
                                        <input type="file" class="form-control" name="update_g_doc[]" id="update_g_doc"
                                            multiple>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                        <button class="btn btn-danger btn-lg" id="cncl_add_doc">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            @else
                            <div class="text-center p-2 bg-danger"><span class="text-light fw-bold fs-lg">No Documents
                                    Found</span></div>
                            <div class="text-center mt-2"><button class="btn btn-success btn-lg" data-bs-toggle="modal"
                                    data-bs-target="#mul_doc_edit_modal{{$id}}">Add Documents</button></div>
                            @include('Admin.Pages.modals.multiple_doc_edit_modal')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-4 p-2">
                <div class="card-header bg-primary text-center">
                    <span class="fw-semibold fs-lg text-white">Edit Guardian Details</span>
                </div>
                <div class="card-body">
                    <div class="form-group bmd-form-group is-filled">
                        <form method="post" action="{{route('admin.guardian.update')}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="update_g_id" value="{{$query[0]->g_id}}">
                            {{-- <div class="mb-3">
                                <label class="form-label" for="update_g_card_no">Guardian Aadhaar No.</label>
                                <input type="number" name="update_g_card_no" class="form-control" id="update_g_card_no"
                                    placeholder="Enter Guardian's Aadhaar No." aria-describedby="emailHelp"
                                    onkeypress="limitKeypress(event,this.value,12)"
                                    value="{{ $query[0]->adh_no == null ? '' : $query[0]->adh_no }}"
                                    onchange="g_adh_chk(this);">
                                <span class="text-danger" id="update_g_adhr_sts"></span>
                            </div> --}}
                            <div class="mb-3">
                                <label class="form-label">Name of the Guardian</label>
                                <input type="text" name="update_g_name" class="form-control" id="update_g_name"
                                    placeholder="Enter Guardian's Name." aria-describedby="emailHelp"
                                    value="{{$query[0]->g_name}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Guardian Gender</label>
                                <div class="space-x-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example1"
                                            name="update_g_gender" value="Male" {{ $query[0]->g_gender == 'Male' ?
                                        'checked' : '' }}>
                                        <label class="form-check-label" for="example1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example2"
                                            name="update_g_gender" value="Female" {{ $query[0]->g_gender == 'Female' ?
                                        'checked' : '' }}>
                                        <label class="form-check-label" for="example2">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example3"
                                            name="update_g_gender" value="Others" {{ $query[0]->g_gender == 'Others' ?
                                        'checked' : '' }}>
                                        <label class="form-check-label" for="example3">Others</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Guardian's Address</label>
                                <textarea rows="3" placeholder="Enter Guardian's Address" name="update_g_add"
                                    class="form-control" id="update_g_add">{{$query[0]->g_address}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Post Office</label>
                                <input type="text" name="update_g_post_office" class="form-control"
                                    id="update_g_post_office" placeholder="Enter Post Office"
                                    aria-describedby="emailHelp" value="{{$query[0]->g_post_office}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">PIN Code</label>
                                <input type="number" name="update_g_pin" class="form-control" id="update_g_pin"
                                    placeholder="Enter PIN Code." aria-describedby="emailHelp"
                                    onkeypress="limitKeypress(event,this.value,6)" value="{{$query[0]->g_pin_code}}"
                                    onchange="g_pin_check(this);">
                                <span class="text-danger" id="update_g_pin_sts"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Guardian's Contact No.</label>
                                <input type="number" name="update_g_contact1" class="form-control" maxlength="10"
                                    id="update_g_contact1" placeholder="Enter Guardian's Contact No."
                                    aria-describedby="emailHelp" onkeypress="limitKeypress(event,this.value,10)"
                                    value="{{$query[0]->g_contact_1}}" onchange="g_cont_chk1(this);">
                                <span class="text-danger" id="update_g_cont_sts1"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Guardian's Alternate Contact No.</label>
                                <input type="number" name="update_g_contact2" class="form-control" maxlength="10"
                                    id="update_g_contact2" placeholder="Enter Guardian's Alternate Contact No."
                                    aria-describedby="emailHelp" onkeypress="limitKeypress(event,this.value,10)"
                                    value="{{$query[0]->g_contact_2}}" onchange="g_alt_cont(this);">
                                <span class="text-danger" id="update_g_cont_sts2"></span>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg" style="margin-right: 10px;"
                                    id="g_edit_btn">Submit</button>
                                <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            @include('Admin.Pages.guardian_profile')
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script src="{{ url('/') }}/assets/js/lib/jquery2.min.js"></script>
<script>
    $(document).ready(function () {
        $('#add_doc').hide();
    });

    $('#g_add_doc').click(function (e) {
        e.preventDefault();
        $('#add_doc').show();
        $('#g_add_doc').hide();
    });

    $('#cncl_add_doc').click(function (e) {
        e.preventDefault();
        $('#g_add_doc').show();
        $('#add_doc').hide();
    });


    function g_adh_chk(event) {
            var x = $('#update_g_card_no').val();

            var fd={
            'adh_no':x
            };
            var url = "{{ route('admin.chk_any2') }}";

            if(x.length == 12)
            {
            $('#update_g_adhr_sts').html('');
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
            var old =  $('#old_adh').val();
            if (response == 0 || old == x) {
            $('#update_g_adhr_sts').html('');
            $('#g_edit_btn').prop('disabled', false);
            }
            else {
            $('#update_g_adhr_sts').html('Guardian Aadhar No. already exists');
            $('#g_edit_btn').prop('disabled', true);
            }
            }
            });
            }
            else if(x.length == 0)
            {
            $('#update_g_adhr_sts').html('');
            $('#g_edit_btn').prop('disabled', true);
            }
            else
            {
            $('#update_g_adhr_sts').html('Aadhar No. must have 12 digits.You have entered '+x.length+' digits.');
            $('#g_edit_btn').prop('disabled', true);
            }
        }

        function g_cont_chk1(event) {
            var s = $('#update_g_contact1').val();

            var fd={
            'g_contact_1':s
            };
            var url = "{{ route('admin.chk_any2') }}";

            if(s.length == 10)
            {
            $('#update_g_cont_sts1').html('');
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
            $('#update_g_cont_sts1').html('');
            $('#g_edit_btn').prop('disabled', false);
            }
            else {
            $('#update_g_cont_sts1').html('Student Contact No. already exists');
            $('#g_edit_btn').prop('disabled', true);
            }
            }
            });
            }
            else if(s.length == 0)
            {
            $('#update_g_cont_sts1').html('');
            $('#g_edit_btn').prop('disabled', true);
            }
            else
            {
            $('#update_g_cont_sts1').html('Contact No. must have 10 digits.You have entered '+s.length+' digits.');
            $('#g_edit_btn').prop('disabled', true);
            }
        }

        function g_alt_cont(event) {
            var n1 = $('#update_g_contact2').val();
            var n2 = $('#update_g_contact1').val();

            if(n1 == n2)
            {
                $('#update_g_cont_sts2').html('Contact No. Already Provided');
                $('#g_edit_btn').prop('disabled', true);
            }
            else if(n1.length == 0)
            {
                $('#update_g_cont_sts2').html('');
                $('#g_edit_btn').prop('disabled', false);
            }
            else if(n1.length < 10)
            {
            $('#update_g_cont_sts2').html('Contact No. must have 10 digits.<br>You have entered '+n1.length+' digits.');
            $('#g_edit_btn').prop('disabled', true);
            }
        }

        function g_pin_check(event){
            var p = $('#update_g_pin').val();
            if (p.length == 6)
            {
            $('#update_g_pin_sts').html('');
            $('#g_edit_btn').prop('disabled', false);
            }
            else if(p.length == 0)
            {
            $('#update_g_pin_sts').html('');
            $('#g_edit_btn').prop('disabled', true);
            }
            else
            {
            $('#update_g_pin_sts').html('PIN Code must have 6 digits.<br>You have entered '+p.length+' digits.');
            $('#g_edit_btn').prop('disabled', true);
            }
        }

    function getstudetails(e){
        e.preventDefault();
        var year = $('#ac_year option:selected').text();
        var url = "{{route('admin.guardian.getgurdetails')}}";
        $.ajax({
            type: "get",
            url: url,
            data: {
                'year':year
            },
            dataType: "json",
            success: function (response) {
                if(response.length == 0)
                {
                var data = "";
                data = data + "<tr>";
                data = data + "<td colspan='2' class='fw-semibold text-danger text-center'>No Data Found</td>";
                data = data + "</tr>";
                $('#tble').html(data);
                }
                else
                {
                var data = "";
                $.each(response, function (index, value) {
                data = data + "<tr>";
                data = data + "<td class='fw-semibold'>";
                data = data + "Name: "+value.s_name+"<br>";
                data = data + "ID: "+value.student_id+"<br>";
                data = data + "Class: "+value.c_name+"<br>";
                data = data + "</td>";
                data = data + "<td class='text-center'>";
                var u = "{{route('getqual',':id')}}";
                u = u.replace(':id',value.student_id);
                data = data + "<a class='btn btn-sm btn-dark' href='"+u+"' target='_blank'>View "+value.s_name+"'s Details</a>";
                data = data + "</td>";
                data = data + "</tr>";
                });
                $('#tble').html(data);
                }
                }
            });
    }
</script>
@endsection
