@extends('Admin.Layout.main')

@section('title')
<title>Assign Teacher</title>
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
    <div class="card p-4 mb-3 mt-3 w-50" style="margin-left: 20%;">
        <div class="text-center card-header heading">
            <h1>Assign Teacher</h1>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    {{-- md= medium device, sm= small device, xs= extra small, xl= extra large --}}
                    <form class="row" method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="tea_id">Specialized Subject</label>
                            <input type="hidden" name="sub_id" id="sub_id">
                            <select class="js-select2 form-select" id="tea_id" name="tea_id" style="width: 100%;"
                                data-placeholder="Choose one.." onchange="tea_sub(event);">
                                <option></option>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                @foreach ($t as $key => $item)
                                <option value="{{$item->id}}">{{$item->t_name}}-{{$item->t_id}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-12 mb-3" id="s_code">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-info btn-lg" style="margin-right:10px;">Submit</button>
                            <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    {{-- md= medium device, sm= small device, xs= extra small, xl= extra large --}}
                    <form class="row" method="post" action="{{route('admin.teacher.other_sub_assign')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="other_subs">Other Subjects to Assign</label>
                            <select class="js-select2 form-select" id="other_subs" name="other_subs"
                                style="width: 100%;" data-placeholder="Choose one.." onchange="get_sub(event);">
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->

                            </select>
                        </div>
                        <input type="hidden" id="n_t_id" name="n_t_id">
                        <div class="col-md-12 mb-3" id="other_s_code">
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
</div>
@endsection

@section('custom_js')
<script src="{{ url('/') }}/assets/js/lib/jquery2.min.js"></script>
<script>
    function tea_sub(e) {

        var url = "{{route('admin.get_subject')}}";
        var t_id =  $('#tea_id').val();
        $('#n_t_id').val(t_id);
        $.ajax({
            type: "get",
            url: url,
            data: {
                't_id':t_id
            } ,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                var data = "";
                $.each(response, function (index, value) {

                    data = data+`<input class="form-check-input" ${(value.as_t != null)?'checked disabled':''} type="checkbox" name="sub[]" value="${value.s_id}">`;

                    data = data+"<label> ";
                    data = data+value.sub_code;
                    data = data+" </label><br>";
                });
                $('#s_code').html(data);
                $('#sub_id').val(response[0].sub_id);
                get_others(response[0].sub_id);
            }
        });
     }

    function get_others(sel) {
        var url = "{{route('admin.get_other_subject')}}";
        $.ajax({
            type: "get",
            url: url,
            data: {
                's_id':sel
            } ,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                var data = "";
                // var top = `<select class="js-select2 form-select" id="other_subs" name="other_subs" style="width: 100%;"
                //                 data-placeholder="Choose one.." >`;
                data = data+'<option></option>';
                $.each(response, function (index, value) {
                 data = data+`<option value="${value.id}">${value.sub_name}`;
                data = data+'</option>';
                });
                // data = data+'</select>';
            $('#other_subs').html(data);
            }
        });

     }

    function get_sub(e) {
            var url = "{{route('admin.get_other_subject_2')}}";
            var s_id = $('#other_subs').val();
            $.ajax({
            type: "get",
            url: url,
            data: {
            'o_s':s_id
            } ,
            dataType: "json",
            success: function (response) {
            // console.log(response);
            var data = "";
            $.each(response, function (index, value) {
                data = data+`<input class="form-check-input" ${(value.as_t != null)?'checked disabled':''} type="checkbox" name="o_sub[]" value="${value.id}">`;
                data = data+"<label> ";
                data = data+value.sub_code;
                data = data+" </label><br>";
            });
            $('#other_s_code').html(data);
            }
            });
            }
</script>
@endsection
