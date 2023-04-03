@extends('Admin.Layout.main')

@section('title')
<title>Add Student</title>
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
    <h1 class="text-center heading">Add Student</h1>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{-- md= medium device, sm= small device, xs= extra small, xl= extra large --}}
            <div class="card p-4 mb-3">
                <form class="row" method="post">
                    <div class="col-md-6 mb-4">
                        <label class="form-label" for="s_id_type">ID Type</label>
                        <select class="js-select2 form-select" id="s_id_type" name="s_id_type" style="width: 100%;"
                            data-placeholder="Choose one.." onchange="id_reset1(event);">
                            <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            <option value="voterid">Voter ID</option>
                            <option value="aadhaar">Aadhaar Card</option>
                            <option value="pan">PAN</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3" id="s_adh">
                        <label class="form-label">Guardian Aadhaar No.</label>
                        <input type="number" onchange="adr_chk1(this);" name="s_card_no" class="form-control"
                            id="s_card_no" placeholder="Enter Guardian's Aadhaar No." aria-describedby="emailHelp"
                            onkeypress="limitKeypress(event,this.value,12)">
                        <span id="s_id_card_sts" class="text-danger"></span>
                        <button type="button" class="btn btn-lg btn-alt-secondary mt-3" data-bs-toggle="modal"
                            data-bs-target="#g_add_modal" title="Edit Guardian" id="add_gur">
                            <i class="fa fa-fw si si-plus"></i>
                        </button>
                        @include('Admin.Pages.modals.g_add_modal')
                    </div>
                </form>
                <div class="row col-md-12">
                    <form class="row" method="post" action="{{route('admin.student.create')}}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-5 mb-3" id="stu_adh">
                            <label class="form-label">Student Aadhaar No.</label>
                            <input type="number" name="stu_card_no" class="form-control" id="stu_card_no"
                                placeholder="Enter Student's Aadhaar No." aria-describedby="emailHelp"
                                onkeypress="limitKeypress(event,this.value,12)" onchange="s_adh_chk(this);">
                            <span id="stu_id_card_sts" class="text-danger"></span>
                        </div>
                        <div id="stu_form" class="row col-md-12">
                            <input type="hidden" value="0" id="gurdian_id" name="gurdian_id">

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Student id No.</label>
                                <input type="text" name="stu_id_no" value="{{$student_id}}" class="form-control"
                                    id="stu_id_no" placeholder="Enter Student's Registration No."
                                    aria-describedby="emailHelp" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name of the Student</label>
                                <input type="text" name="stu_name" class="form-control" id="stu_name"
                                    placeholder="Enter Student's Name." aria-describedby="emailHelp" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Student Gender</label>
                                <div class="space-x-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example-radios-inline1"
                                            name="s_gender" value="Male" checked required>
                                        <label class="form-check-label" for="example-radios-inline1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example-radios-inline2"
                                            name="s_gender" value="Female" required>
                                        <label class="form-check-label" for="example-radios-inline2">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example-radios-inline3"
                                            name="s_gender" value="Others" required>
                                        <label class="form-check-label" for="example-radios-inline3">Others</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Student's Contact No.</label>
                                <input type="number" name="stu_contact1" class="form-control" id="stu_contact1"
                                    placeholder="Enter Student's Contact No." aria-describedby="emailHelp"
                                    onkeypress="limitKeypress(event,this.value,10)" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Student's Address</label>
                                <div class="form-check col-md-6 mb-3">
                                    <input class="form-check-input" type="checkbox" value="" id="stu_add_chk"
                                        name="stu_add_chk">
                                    <label class="form-check-label" for="stu_add_chk">Same as Guardian Address</label>
                                </div>
                                <textarea rows="3" placeholder="Enter Student's Address" name="stu_add"
                                    class="form-control" id="stu_add"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Post Office</label>
                                <input type="text" name="stu_post_office" class="form-control" id="stu_post_office"
                                    placeholder="Enter Post Office" aria-describedby="emailHelp" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">PIN Code</label>
                                <input type="number" name="stu_pin" class="form-control" id="stu_pin"
                                    placeholder="Enter PIN Code." aria-describedby="emailHelp"
                                    onchange="pin_chk1(this);" onkeypress="limitKeypress(event,this.value,6)">
                                <span class="text-danger" id="stu_pin_sts"></span>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Student's Date of Birth</label>
                                <input type="text" class="js-datepicker form-control" id="stu_dob" name="stu_dob"
                                    data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                    data-date-format="dd/mm/yyyy" placeholder="Choose Date of Birth" required>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label" for="stu_class">Class</label>
                                <select class="js-select2 form-select" id="stu_class" name="stu_class"
                                    style="width: 100%;" data-placeholder="Choose one.." onchange="sec_select(this);"
                                    required>
                                    <option></option>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                    @foreach ($y as $key => $item)
                                    <option value="{{ $item->id }}">{{ $item->c_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label" for="stu_section">Section</label>
                                <select class="js-select2 form-select" id="stu_section" name="stu_section"
                                    style="width: 100%;" data-placeholder="Choose one.."
                                    onchange="getcapacity(this,event);" required>
                                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Student Roll No.</label>
                                <input type="text" name="stu_roll" class="form-control" id="stu_roll"
                                    placeholder="Enter Student's Roll No." aria-describedby="emailHelp">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Upload Student's Photo</label>
                                <input type="file" class="form-control" name="s_photo" id="s_photo">
                                @if ($errors->has('s_photo'))
                                <span class="text-danger fw-semibold fs-sm">{{$errors->first('s_photo')}}</span>
                                @else
                                <span class="text-info fw-semibold fs-sm">Only JPG, PNG and JPEG formats are
                                    allowed.<br>File size must be in 20 KB.</span>
                                @endif
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Upload Student's Documents</label>
                                <input type="file" class="form-control" name="s_doc[]" id="s_doc" multiple required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Capacity</label>
                                <input type="number" name="stu_capacity" class="form-control" id="stu_capacity"
                                    placeholder="Enter Capacity" aria-describedby="emailHelp" readonly>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="stu_r_fees">Registration Fees</label>
                                <input class="form-control" type="number" value="" id="stu_r_fees" name="stu_r_fees"
                                    readonly required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="stu_t_fees">Tution Fees</label>
                                <input class="form-control" type="number" value="" id="stu_t_fees" name="stu_t_fees">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label" for="stu_o_fees">Other Fees</label>
                                <input class="form-control" type="number" value="" id="stu_o_fees" name="stu_o_fees">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-lg"
                                    style="margin-right:10px;">Submit</button>
                                <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script src="{{ url('/') }}/assets/js/lib/jquery2.min.js"></script>
<script>
    $(document).ready(function() {
            $('#stu_adh').hide();
            $('#other').hide();
            $('#add_gur').hide();
            $('#stu_form').hide();
            $('#stu_t_fees').attr("placeholder", 'Enter Tution Fees');
            $('#stu_o_fees').attr("placeholder", 'Enter Other Fees');
        });

        function id_reset(e) {//modal page id select
            e.preventDefault();

            $('#g_card_no').val('');
            $('#stu_adh').hide();
            $('#id_card_sts').html('');
        }

        function id_reset1(e) {//main page id select
            e.preventDefault();

            $('#s_card_no').val('');
            $('#stu_adh').hide();
            $('#s_id_card_sts').html('');
        }
        function adr_chk(event) {// modal page adhar chek guadian

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
                else
                {
                    $('#id_card_sts').html(x+' must be '+len+' digits.<br>You have entered '+c.length+' digits.');
                    $('#other').hide();
                }
    }

    function adr_chk1(event) {// main page adhar chek guardian
        var x = $('#s_id_type option:selected').val();
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

        var c = $('#s_card_no').val().trim();
        var fd={
            'g_v_doc':x,
            'adh_no':c
        };
        var url = "{{ route('admin.get_any2') }}";
        if(c.length == len)
            {
                $('#s_id_card_sts').html('');
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
                    if (response.length == 0) {
                     $('#add_gur').show();
                    $('#stu_adh').hide();
                    } else {
                    $('#stu_adh').show();
                    $('#add_gur').hide();
                    $('#gurdian_id').val(response[0].id);
                        $('#s_id_card_sts').html(x+' No. Already Exists!');
                        // $('#other').hide();
                    }
                }
            });
            }
            else if(c.length == 0)
            {
                $('#s_id_card_sts').html('');
                // $('#other').hide();
            }
            else
            {
                 $('#s_id_card_sts').html(x+' must be '+len+' digits.<br>You have entered '+c.length+' digits.');
                 // $('#other').hide();
            }
    }

    function s_adh_chk(event) {// main page adhar chek student
        var x = $('#stu_card_no').val();

        var fd={
            's_adh_no':x
        };
        var url = "{{ route('admin.chk_any2') }}";

        if(x.length == 12)
        {
            $('#stu_id_card_sts').html('');
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
                $('#stu_id_card_sts').html('');
                $('#stu_form').show();
            }
            else {
             $('#stu_id_card_sts').html('Student Aadhar No. already exists');
             $('#stu_form').hide();
            }
        }
        });
        }
        else if(x.length == 0)
        {
            $('#stu_id_card_sts').html('');
            $('#stu_form').hide();
        }
        else
        {
        $('#stu_id_card_sts').html('Aadhar No. must have 12 digits.<br>You have entered '+x.length+' digits.');
        $('#stu_form').hide();
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

        function pin_chk1(event) {
            var p = $('#stu_pin').val();
            if(p.length == 0)
            {
                $('#stu_pin_sts').html('');
            }
            else
            {
                if(p.length < 6)
                {
                $('#stu_pin_sts').html('PIN Code must be 6 digits.<br>You have entered '+p.length+' digits.');
                }
                else
                {
                $('#stu_pin_sts').html('');
                }
            }
        }

        $('#add_gur').click(function (e) {
            e.preventDefault();
            var c = $('#s_card_no').val().trim();
            var x = $('#s_id_type option:selected').val();
            var b = x+'';
            // $("#id_type select").val(x+'');
            // $('#id_type').find('option[value='+b+']').attr('selected','selected');
            $("#id_type option:contains(" + b + ")").attr('selected', 'selected');
            // $("#id_type > [value=" + b + "]").attr("selected", "true");
            $('#g_card_no').val(c);
        });

        $('#stu_add_chk').change(function (e) {
            e.preventDefault();
            if(this.checked)
            {
                var g_adh = $('#s_card_no').val();
                var url = "{{ route('admin.get_any2') }}";
                var fd = {
                    'adh_no': g_adh
                }
                $.ajax({
                type: "get",
                url: url,
                data: {
                    'f_n': JSON.stringify(fd),
                    't_n': 'guardians',


                },
                dataType: "JSON",
                success: function (response) {
                    $('#stu_post_office').val(response[0].g_post_office);
                    $('#stu_add').val(response[0].g_address);
                    $('#stu_pin').val(response[0].g_pin_code);
                }
               });
            }
            else
            {
                $('#stu_post_office').val('');
                $('#stu_add').val('');
                $('#stu_pin').val('');
            }

        });

        function sec_select(event) {
            var s_c = $('#stu_class').val();
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
        function getcapacity(sel,e){
            e.preventDefault();
            var sec_id =  $('#stu_section').val();
            var url = "{{route('admin.data_fetch')}}";
            var fd = {
                'id': sec_id
            }

            $.ajax({
                type: "get",
                url: url,
                data: {
                    'f_n': sec_id
                },
                dataType: "JSON",
                success: function (response) {
                    $('#stu_capacity').val(response);
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
                            $('#stu_r_fees').val('');
                            $('#stu_t_fees').attr("placeholder", 'Enter Tution Fees');
                            $('#stu_o_fees').attr("placeholder", 'Enter Other Fees');
                        } else {
                            $('#stu_r_fees').val(response[0].r_fees);
                            $("#stu_t_fees").attr("placeholder", 'Enter Tution Fees '+response[0].t_fees);
                            $("#stu_o_fees").attr("placeholder", 'Enter Other Fees '+response[0].o_fees);
                        }
                    }
                });
         }
</script>
@endsection
