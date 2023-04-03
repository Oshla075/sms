@extends('Admin.Layout.main')

@section('title')
<title>Edit Student {{$item[0]->s_name}}</title>
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
    $id = $item[0]->student_id;
    $name = $item[0]->s_name;
    $table = "students";
    $find_field = "student_id";
    $update_field = "s_doc";
    $des_f = "students";
@endphp
<div class="container">
    <h1 class="text-center heading">Edit Student {{$item[0]->s_name}}</h1>
    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header bg-info text-center">
                    <span class="fw-semibold fs-lg text-white">Edit Basic Student Details</span>
                </div>
                <div class="card-body">
                    <div class="form-group bmd-form-group is-filled">
                        <form class="row" method="post" action="{{route('admin.student.update')}}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$item[0]->student_id}}" id="update_student_id"
                                name="update_student_id">
                            <div class="mb-3" id="stu_adh">
                                <label class="form-label">Student Aadhaar No.</label>
                                <input type="number" name="update_stu_card_no" class="form-control"
                                    id="update_stu_card_no" placeholder="Enter Student's Aadhaar No."
                                    aria-describedby="emailHelp" value="{{$item[0]->s_adh_no}}"
                                    onkeypress="limitKeypress(event,this.value,12)" onchange="s_adh_chk(this);">
                                    <span class="text-danger" id="update_stu_id_card_sts"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name of the Student</label>
                                <input type="text" value="{{$item[0]->s_name}}" name="update_stu_name"
                                    class="form-control" id="update_stu_name" placeholder="Enter Student's Name."
                                    aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Student Gender</label>
                                <div class="space-x-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example1"
                                            name="update_s_gender" value="Male" {{ $item[0]->s_gender == 'Male' ?
                                        'checked'
                                        : '' }} required>
                                        <label class="form-check-label" for="example1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example2"
                                            name="update_s_gender" value="Female" {{ $item[0]->s_gender == 'Female' ?
                                        'checked' : '' }} required>
                                        <label class="form-check-label" for="example2">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example3"
                                            name="update_s_gender" value="Others" {{ $item[0]->s_gender == 'Others' ?
                                        'checked' : '' }} required>
                                        <label class="form-check-label" for="example3">Others</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Student's Contact No.</label>
                                <input type="number" name="update_stu_contact1" class="form-control"
                                    id="update_stu_contact1" placeholder="Enter Student's Contact No."
                                    value="{{$item[0]->s_contact}}" aria-describedby="emailHelp"
                                    onkeypress="limitKeypress(event,this.value,10)" onchange="s_cont_chk(this);" required>
                                    <span class="text-danger" id="update_stu_cont_no_sts"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Student's Address</label>
                                <textarea rows="3" placeholder="Enter Student's Address" name="update_stu_add"
                                    class="form-control" id="update_stu_add">{{$item[0]->s_address}}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Post Office</label>
                                <input type="text" name="update_stu_post_office" class="form-control"
                                    id="update_stu_post_office" placeholder="Enter Post Office"
                                    value="{{$item[0]->s_post_office}}" aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">PIN Code</label>
                                <input type="number" name="update_stu_pin" class="form-control" id="update_stu_pin"
                                    placeholder="Enter PIN Code." value="{{$item[0]->s_pin_code}}"
                                    aria-describedby="emailHelp" onkeypress="limitKeypress(event,this.value,6)" onchange="s_pin_check(this);">
                                    <span class="text-danger" id="update_stu_pin_sts"></span>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Student's Date of Birth</label>
                                <input type="text" class="js-datepicker form-control" id="stu_dob" name="stu_dob"
                                    data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                    value="{{$item[0]->s_dob}}" data-date-format="dd/mm/yyyy"
                                    placeholder="Choose Date of Birth" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Student Roll No.</label>
                                <input type="text" name="update_stu_roll" class="form-control" id="update_stu_roll"
                                    placeholder="Enter Student's Roll No." value="{{$item[0]->s_roll}}"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-lg"
                                    style="margin-right:10px;" id="s_edit_btn">Submit</button>
                                <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card mb-4 p-2">
                <div class="card-header bg-info text-center">
                    <span class="fw-semibold fs-lg text-white">View Student Documents</span>
                </div>
                <div class="card-body">
                    <div class="form-group bmd-form-group is-filled">
                        <div class="mb-3">
                            @php
                                $b = array();
                                $sub = Str::substr($item[0]->s_doc,0,Str::length($item[0]->s_doc)-1);
                                $b = explode(',',$sub);
                            @endphp
                            @if ($b[0]!="")
                                @foreach ($b as $key=>$item1)
                                <a href="{{url('/storage')}}/students/{{$item[0]->student_id}}/{{$item1}}" target="_blank" class="btn btn-primary btn-sm" style="padding-right: 40px !important; margin-right: 20px;">{{++$key}}
                                </a>
                                <a href="{{url('/admin/multi_data_remove/')}}/{{$item1}}/{{$item[0]->s_doc}}/{{$item[0]->student_id}}/student_id/s_doc/students/students" onclick="return confirm('Are you sure you want to delete this document?')"><span class="badge badge-danger" style="background-color: red !important; margin-left: -40px;"><i class="fa fa-fw fa-times"></i></span></a>
                                @endforeach
                                <div class="text-center mt-3"><button class="btn btn-success btn-lg" id="s_add_doc">Add Documents</button></div>
                            <div id="add_s_doc">
                                <form action="{{route('edit_multi_docs_3')}}" enctype="multipart/form-data" method="post">
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
                                        <button type="submit" class="btn btn-info btn-lg">Submit</button>
                                        <button class="btn btn-danger btn-lg" id="cncl_add_doc">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            @else
                                <div class="text-center p-2 bg-danger"><span class="text-light fw-bold fs-lg">No Documents Found</span></div>
                                <div class="text-center mt-2"><button class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#mul_doc_edit_modal{{$id}}">Add Documents</button></div>
                                @include('Admin.Pages.modals.multiple_doc_edit_modal')
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-4 mb-4">
                <div class="card-header bg-info text-center">
                    <span class="fw-semibold fs-lg text-white">Edit Student Class and Fees Details</span>
                </div>
                <div class="card-body">
                    <div class="form-group bmd-form-group is-filled">
                        <form class="row" method="post" action="{{route('admin.student.update_class')}}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" value="{{$item[0]->student_id}}" id="update_student_id"
                                name="update_student_id">
                            <div class="mb-2">
                                <label class="form-label" for="update_stu_class">Class</label>
                                <select class="js-select2 form-select" onchange="sec_select(this);"
                                    id="update_stu_class" name="update_stu_class" style="width: 100%;"
                                    data-placeholder="Choose one.." required>
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach ($class as $key => $item2)
                                    <option value="{{ $item2->id }}" {{ $item[0]->s_cls_id == $item2->id ? 'selected' :
                                        ''}}>{{ $item2->c_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2" id="org_section">
                                <label class="form-label" for="update_stu_section">Section</label>
                                <select class="js-select2 form-select" id="update_stu_section" name="update_stu_section"
                                    style="width: 100%;" data-placeholder="Choose one.." required>
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach ($section as $key => $item3)
                                    <option value="{{ $item3->id }}" {{ $item[0]->s_sec_id == $item3->id ? 'selected' :
                                        ''}}>{{ $item3->s_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-2" id="new_section">
                                <label class="form-label" for="stu_section">Section</label>
                                <select class="js-select2 form-select" id="stu_section" name="update_stu_section"
                                    style="width: 100%;" data-placeholder="Choose one.." required>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="update_stu_r_fees">Registration Fees</label>
                                <input class="form-control" type="number" value="{{$item[0]->s_r_fees}}"
                                    id="update_stu_r_fees" name="update_stu_r_fees" readonly required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="update_stu_t_fees">Tution Fees</label>
                                <input class="form-control" type="number" value="{{$item[0]->s_t_fees}}"
                                    id="update_stu_t_fees" name="update_stu_t_fees" placeholder="{{$item[0]->s_t_fees == null ? 'Enter Tution Fees': $item[0]->s_t_fees}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="update_stu_o_fees">Other Fees</label>
                                <input class="form-control" type="number" value="{{$item[0]->s_o_fees}}"
                                    id="update_stu_o_fees" name="update_stu_o_fees" placeholder="{{$item[0]->s_o_fees == null ? 'Enter Other Fees': $item[0]->s_o_fees}}">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-lg"
                                    style="margin-right:10px;">Submit</button>
                                <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            @include('Admin.Pages.student_profile')
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script src="{{ url('/') }}/assets/js/lib/jquery2.min.js"></script>
<script>
    $(document).ready(function() {
            $('#new_section').hide();
            $('#add_s_doc').hide();
        });

    $('#s_add_doc').click(function (e) {
        e.preventDefault();
        $('#add_s_doc').show();
        $('#s_add_doc').hide();
        });

    $('#cncl_add_doc').click(function (e) {
        e.preventDefault();
        $('#s_add_doc').show();
        $('#add_s_doc').hide();
    });

    // function del_doc(event) {
    //     Swal.fire({
    //     title: 'Are you sure you want to Delete this Document?',
    //     text: "You won't be able to revert this!",
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes, Delete it!'
    //     }).then((result) => {
    //     if (result.isConfirmed) {
    //         Swal.fire(
    //         'Deleted!',
    //         'Document Deleted Successfully',
    //         'success'
    //         )
    //         window.location.reload();
    //     }
    //     })
    // }

        function sec_select(event) {
            // event.preventDefault();
            $('#org_section').hide();
            $('#new_section').show();

            var s_c = $('#update_stu_class').val();
            var url = "{{ route('admin.get_any2_order') }}";
                var fd = {
                    'c_id': s_c
                }
                var od =[
                    's_name','asc'
                ]
                $.ajax({
                type: "get",
                url: url,
                data: {
                    'f_n': JSON.stringify(fd),
                    'order':JSON.stringify(od),
                    't_n': 'sections',
                },
                dataType: "JSON",
                success: function (response) {
                    var data = "";
                    $.each(response, function (index, value) {
                       data = data + '<option value='+value.id+'>';
                       data = data + value.s_name;
                       data = data + '</option>';
                    });
                    $('#stu_section').html(data);
                    amtTot(s_c);
                }
               });
        }

        function amtTot(s_c) {
            var url = "{{ route('admin.get_any2') }}";
                var fd = {
                    'c_id': s_c
                }
                $.ajax({
                    type: "get",
                    url: url,
                    data:  {
                    'f_n': JSON.stringify(fd),
                    't_n': 'class_fees',
                    },
                    dataType: "JSON",
                    success: function (response) {
                        if (response.length == 0) {
                            $('#update_stu_r_fees').val('');
                            $('#update_stu_t_fees').attr("placeholder", 'Enter Tution Fees');
                            $('#update_stu_o_fees').attr("placeholder", 'Enter Other Fees');
                        } else {
                            $('#update_stu_r_fees').val(response[0].r_fees);
                            $("#update_stu_t_fees").attr("placeholder", 'Enter Tution Fees '+response[0].t_fees);
                            $("#update_stu_o_fees").attr("placeholder", 'Enter Other Fees '+response[0].o_fees);
                        }
                    }
                });
        }

        function s_adh_chk(event) {
            var x = $('#update_stu_card_no').val();

            var fd={
            's_adh_no':x
            };
            var url = "{{ route('admin.chk_any2') }}";

            if(x.length == 12)
            {
            $('#update_stu_id_card_sts').html('');
            $.ajax({
            type: "get",
            url: url,
            data: {
            'f_n': JSON.stringify(fd),
            't_n': 'students',
            },
            dataType: "JSON",
            success: function(response) {
            console.log(response);
            if (response == 0) {
            $('#update_stu_id_card_sts').html('');
            $('#s_edit_btn').prop('disabled', false);
            }
            else {
            $('#update_stu_id_card_sts').html('Student Aadhar No. already exists');
            $('#s_edit_btn').prop('disabled', true);
            }
            }
            });
            }
            else if(x.length == 0)
            {
            $('#update_stu_id_card_sts').html('');
            $('#s_edit_btn').prop('disabled', true);
            }
            else
            {
            $('#update_stu_id_card_sts').html('Aadhar No. must have 12 digits.<br>You have entered '+x.length+' digits.');
            $('#s_edit_btn').prop('disabled', true);
            }
        }

        function s_cont_chk(event) {
            var s = $('#update_stu_contact1').val();

            var fd={
            's_contact':s
            };
            var url = "{{ route('admin.chk_any2') }}";

            if(s.length == 10)
            {
            $('#update_stu_cont_no_sts').html('');
            $.ajax({
            type: "get",
            url: url,
            data: {
            'f_n': JSON.stringify(fd),
            't_n': 'students',
            },
            dataType: "JSON",
            success: function(response) {
            console.log(response);
            if (response == 0) {
            $('#update_stu_cont_no_sts').html('');
            $('#s_edit_btn').prop('disabled', false);
            }
            else {
            $('#update_stu_cont_no_sts').html('Student Contact No. already exists');
            $('#s_edit_btn').prop('disabled', true);
            }
            }
            });
            }
            else if(s.length == 0)
            {
            $('#update_stu_cont_no_sts').html('');
            $('#s_edit_btn').prop('disabled', true);
            }
            else
            {
            $('#update_stu_cont_no_sts').html('Contact No. must have 10 digits.<br>You have entered '+s.length+' digits.');
            $('#s_edit_btn').prop('disabled', true);
            }
        }
        function s_pin_check(event){
            var p = $('#update_stu_pin').val();
            if (p.length == 6)
            {
            $('#update_stu_pin_sts').html('');
            $('#s_edit_btn').prop('disabled', false);
            }
            else if(p.length == 0)
            {
            $('#update_stu_pin_sts').html('');
            $('#s_edit_btn').prop('disabled', true);
            }
            else
            {
            $('#update_stu_pin_sts').html('PIN Code must have 6 digits.<br>You have entered '+p.length+' digits.');
            $('#s_edit_btn').prop('disabled', true);
            }
        }
</script>
@endsection
