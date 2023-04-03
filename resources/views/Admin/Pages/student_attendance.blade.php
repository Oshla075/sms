@extends('Admin.Layout.main')

@section('title')
<title>Student Search</title>
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
    <h1 class="text-center heading">Student Attendance</h1>
    @php
    $date = date('d-M-Y');
    @endphp
    <div class="row">
        <form method="post" class="row col-md-12 mb-3" action="#" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4 mb-3">
                <label class="form-label" for="aca_year">Year</label>
                <select required class="js-select2 form-select" id="aca_year" name="aca_year" style="width: 100%;"
                    data-placeholder="Choose one..">
                    <option></option>
                    @for($i = date('Y'); $i <= (date('Y')+4); $i++) <option value="{{$i}}">{{$i}}</option>
                        @endfor
                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label" for="stu_class">Class</label>
                <select required class="js-select2 form-select" id="stu_class" name="stu_class" style="width: 100%;"
                    data-placeholder="Choose one.." onchange="sec_select(this);">
                    <option></option>
                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    @foreach ($y as $key => $item)
                    <option value="{{ $item->id }}">{{ $item->c_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label" for="stu_section">Section</label>
                <select required class="js-select2 form-select" id="stu_section" name="stu_section" style="width: 100%;"
                    data-placeholder="Choose one..">
                    <option></option>
                    <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <label class="form-label" for="att_date">Currrent Date</label>
                <input type="text" name="att_date" value="{{$date}}" class="form-control" id="att_date" placeholder=""
                    aria-describedby="emailHelp" readonly>
            </div>
            <div class="text-center">
                <button class="btn btn-info btn-lg" id="attensub">Submit</button>
                <button type="reset" class="btn btn-danger btn-lg">Reset</button>
            </div>
        </form>
        <div class="mt-2" id="dyn_table">
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

        $('#attensub').click(function (e) {
            e.preventDefault();

            var data = "";
            var header = `<thead>
                        <tr>
                            <th style="width: 10%;" class="text-center">Student ID</th>
                            <th style="width: 15%;" class="text-center">Roll No.</th>
                            <th style="width: 15%;" class="text-center">Class</th>
                            <th style="width: 20%;" class="text-center">Section</th>
                        </tr>
                    </thead>`;
            var top_header = `<form action="#" method="get" enctype="multipart/form-data">
                @csrf
                <div class="block block-rounded">
                    <div class="block-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                <tbody>`;
            var footer =`</tbody>
                            </table>
                        </div>
                        <div class="text-center mb-2">
                            <button type="submit" class="btn btn-info btn-lg">Submit</button>
                            <button id="tble_hide" class="btn btn-danger btn-lg">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>`;

            data = data + top_header;
            data = data + header;
            data = data + footer;

            $('#dyn_table').html(data);
        });

        $('#tble_hide').click(function (e) {
            e.preventDefault();
            $('#dyn_table').hide();
        });
</script>
@endsection
