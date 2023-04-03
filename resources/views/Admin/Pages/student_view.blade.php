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
{{-- {{dd($data)}} --}}
<div class="container">
    <h1 class="text-center heading">Student Search</h1>
        @php
            $cur_year = (int)date('Y');
            $date = array();
            for($i=0;$i<5;$i++)
            {
                $date[$i]=$cur_year;
                $cur_year++;
            }
        @endphp
        <div class="row">
            <form method="get" class="row col-md-12 mb-3" action="{{route('admin.student_list')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="aca_year">Year</label>
                    <select required class="js-select2 form-select" id="aca_year" name="aca_year" style="width: 100%;"
                        data-placeholder="Choose one..">
                        <option></option>
                        @foreach ($date as $item)
                           <option value="{{ $item }}">{{ $item }} - {{ ++$item }}</option>
                        @endforeach
                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label" for="stu_class">Class</label>
                    <select required class="js-select2 form-select" id="stu_class" name="stu_class"
                        style="width: 100%;" data-placeholder="Choose one.." onchange="sec_select(this);">
                        <option></option>
                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                        @foreach ($y as $key => $item)
                        <option value="{{ $item->id }}">{{ $item->c_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label" for="stu_section">Section</label>
                    <select required class="js-select2 form-select" id="stu_section" name="stu_section"
                        style="width: 100%;" data-placeholder="Choose one..">
                        <option></option>
                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg" id="disble">Submit</button>
                    <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                </div>
            </form>
        </div>
</div>
@endsection
@section('custom_js')
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
</script>
@endsection
