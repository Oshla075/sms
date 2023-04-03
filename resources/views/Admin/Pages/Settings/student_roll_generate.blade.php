@extends('Admin.Layout.main')

@section('title')
<title>Generate Student Roll No.</title>
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
<div class="row">
    <div class="card col-4">
        <div class="text-center card-header heading">
            <h1>Generate Student Roll No.</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    {{-- md= medium device, sm= small device, xs= extra small, xl= extra large --}}
                    <form class="row" method="get" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="s_year">Choose Year</label>
                            <input type="number" class="form-control" onkeypress="limitKeypress(event,this.value,4)"
                                placeholder="Enter Year" name="s_year" id="s_year">
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="stu_class">Choose Class</label>
                            <select class="js-select2 form-select" id="stu_class" name="stu_class" style="width: 100%;"
                                data-placeholder="Choose one.." onchange="sec_select(this);" id="stu_cls" required>
                                <option></option>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                @foreach ($class as $key => $item)
                                <option value="{{ $item->id }}">{{ $item->c_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="stu_section">Section</label>
                            <select class="js-select2 form-select" id="stu_section" name="stu_section"
                                style="width: 100%;" data-placeholder="Choose one.." required>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            </select>
                        </div>
                        <div class="text-center">
                            <a id="submit_btn" class="btn btn-info btn-lg" style="margin-right:10px;">Submit</a>
                            <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card col-8">
        <div class="table-responsive">
            <form action="{{route('admin.roll_form_submit')}}" method="POST">
                @csrf
                <input type="hidden" name="year" id="year">
                <input type="hidden" name="cls_id" id="cls_id">
                <input type="hidden" name="sec_id" id="sec_id">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center">
                                <input type="checkbox" class="form-check-input" name="main_checkbox" id="main_checkbox">
                            </th>
                            <th class="text-center">Name</th>
                            <th class="text-center">ID</th>
                            <th class="text-center">Class</th>
                            <th class="text-center">Section</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="data">
                    </tbody>
                </table>
                <div id="btn_gtn">
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script src="{{ url('/') }}/assets/js/lib/jquery2.min.js"></script>
<script>
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
                    data = data+`<option selected disabled>Select</option>`;
                    $.each(response, function (index, value) {
                       data = data + '<option value='+value.id+'>';
                       data = data + value.s_name;
                       data = data + '</option>';
                    });
                    $('#stu_section').html(data);
                }
               });
        }

        $('#main_checkbox').click(function () {
            console.log('hello');
            $('.checkBoxClass').prop('checked',$(this).prop('checked'));
        });

        $('#submit_btn').click(function (e) {
            e.preventDefault();
            var year = $("#s_year").val();
            var cls = $('#stu_class').val();
            var sec = $('#stu_section').val();
            var url = "{{route('admin.generate_stu_roll')}}";
            $('#cls_id').val(cls);
            $('#year').val(year);
            $('#sec_id').val(sec);

            $.ajax({
                type: "get",
                url: url,
                data: {
                    'year': year,
                    'cls': cls,
                    'sec': sec
                },
                dataType: "JSON",
                success: function (response) {
                    console.log(response);
                    var data ="";
                    $.each(response, function (index, value) {
                        data = data+"<tr>";
                        data = data+"<td class='text-center'>";
                        data = data+`<input class="form-check-input checkBoxClass" ${(value.s_roll != null)?'checked disabled':''} name="s_ids[]" type="checkbox" value="${value.student_id}">`;
                        data = data+"</td>";
                        data = data+"<td>";
                        data = data+value.stu_name;
                        data = data+"</td>";
                        data = data+"<td>";
                        data = data+value.student_id;
                        data = data+"</td>";
                        data = data+"<td>";
                        data = data+value.c_name;
                        data = data+"</td>";
                        data = data+"<td>";
                        data = data+value.s_name;
                        data = data+"</td>";
                        data = data+"<td>";
                        data = data+"</td>";
                        data = data+"</tr>";
                    });
                    $('#btn_gtn').html(`<input type="submit" style="float:right;" value="Submit" class="btn btn-info">`);
                    $('#data').html(data);

                }
            });

        });

        // $('#stu_chek').change(function (e) {
        //     e.preventDefault();
        //     if(this.checked)
        //     {
        //         $('#oth_s_chk').change(function (e) {
        //             e.preventDefault();
        //             this.checked;
        //         });
        //     }

        // });


</script>
@endsection
