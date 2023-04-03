@extends('Admin.Layout.main')

@section('title')
<title>Add Teacher</title>
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
    <h1 class="text-center heading">Add Teacher</h1>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            {{-- md= medium device, sm= small device, xs= extra small, xl= extra large --}}
            <div class="card p-4 mb-3">
                <form class="row" method="post" action="{{route('admin.teacher.create')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teacher Aadhaar No.</label>
                        <input type="number" name="t_card_no" class="form-control" id="t_card_no"
                            placeholder="Enter Teacher's Aadhaar No." aria-describedby="emailHelp"
                            onkeypress="limitKeypress(event,this.value,12)">
                        <span id="t_id_card_sts" class="text-danger"></span>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teacher Id No.</label>
                        <input type="text" name="t_id_no" value="{{$teacher_id}}" class="form-control" id="t_id_no"
                            placeholder="Enter Teacher's Registration No." aria-describedby="emailHelp" readonly>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name of the Teacher</label>
                        <input type="text" name="t_name" class="form-control" id="t_name"
                            placeholder="Enter Teacher's Name." aria-describedby="emailHelp" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Gender</label>
                        <div class="space-x-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="example-radios-inline1" name="t_gender"
                                    value="Male" checked required>
                                <label class="form-check-label" for="example-radios-inline1">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="example-radios-inline2" name="t_gender"
                                    value="Female" required>
                                <label class="form-check-label" for="example-radios-inline2">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="example-radios-inline3" name="t_gender"
                                    value="Others" required>
                                <label class="form-check-label" for="example-radios-inline3">Others</label>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-6 mb-3">
                        <label class="form-label">Highest Qualification of the Teacher</label>
                        <input type="text" name="t_qual" class="form-control" id="t_qual"
                            placeholder="Enter Teacher's Highest Qualification" aria-describedby="emailHelp" required>
                    </div> --}}
                    <div class="col-md-6 mb-3">
                        <label class="form-label" for="sub_id">Specialized Subject</label>
                        <select class="js-select2 form-select" id="sub_id" name="sub_id" style="width: 100%;"
                            data-placeholder="Choose one..">
                            <option></option>
                            <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            @foreach ($y as $key => $item)
                            <option value="{{ $item->id }}">{{ $item->sub_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teacher's Contact No.</label>
                        <input type="number" name="t_contact" class="form-control" id="t_contact"
                            placeholder="Enter Teacher's Contact No." aria-describedby="emailHelp"
                            onkeypress="limitKeypress(event,this.value,10)" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teacher's Date of Birth</label>
                        <input type="text" class="js-datepicker form-control" id="t_dob" name="t_dob"
                            data-week-start="1" data-autoclose="true" data-today-highlight="true"
                            data-date-format="dd/mm/yyyy" placeholder="Choose Date of Birth" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Teacher's Photo</label>
                        <input type="file" class="form-control" name="t_photo" id="t_photo">
                        @if ($errors->has('t_photo'))
                        <span class="text-danger fw-semibold fs-sm">{{$errors->first('t_photo')}}</span>
                        @else
                        <span class="text-info fw-semibold fs-sm">Only JPG, PNG and JPEG formats are
                            allowed.<br>File size must be in 20 KB.</span>
                        @endif
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Upload Teacher's Documents</label>
                        <input type="file" class="form-control" name="t_doc[]" id="t_doc" multiple>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-info btn-lg" style="margin-right:10px;">Submit</button>
                        <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @section('custom_js')
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
@endsection --}}
