@extends('Admin.Layout.main')

@section('title')
<title>Test Page</title>
@endsection

@section('main_section')
<div class="container py-2 mb-3">

    @if (Session::has('success'))
    <div class="alert alert-success">
        {{Session::get('success')}}
        @php
        Session::forget('success');
        @endphp
    </div>
    @endif
    <form action="{{route('admin.test1')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-4">
            <input type="file" name="image" id="image">
            @if ($errors->has('image'))
            <span class="text-danger">{{$errors->first('image')}}</span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Upload Image</button>
        </div>
    </form>

    <a class="btn btn-lg btn-primary mt-3" id="urlhide">Click to View Google</a>

</div>

<div class="card p-4 mb-3 mt-3 w-50" style="margin-left: 20%;">
    <div class="text-center card-header heading">
        <h1>Add Product</h1>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {{-- md= medium device, sm= small device, xs= extra small, xl= extra large --}}
                <form class="row" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="tea_id">Product ID</label>
                        <input type="text" name="p_id" id="p_id" class="form-control" value="{{$product_id}}" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="tea_id">Product Name</label>
                        <input type="text" name="p_name" id="p_name" class="form-control"
                            placeholder="Enter Product Name">
                  </div>
                    <div class="col-md-12 mb-3">
                    <label class="form-label" for="p_form">Product Form</label>
                    <select class="js-select2 form-select" id="p_form" name="p_form" style="width: 100%;" data-placeholder="Choose one..">
                        <option></option>
                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                        @foreach ($product_form as $key => $item)
                        <option value="{{ $item->id }}">{{ $item->p_form}}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-md-12 mb-3">
                    <label class="form-label" for="d_name">Choose Disease</label><br>
                    @foreach ($disease as $key => $item)
                    <input class="form-check-input" type="checkbox" name="d_name[]" id="d_name" value="{{$item->id}}"> {{$item->d_name}}
                    @endforeach
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="tea_id">Strength</label>
                        <input type="number" name="p_strength" id="p_strength" class="form-control"
                            placeholder="Enter Strength" onchange="mul_rec1(this);">
                    </div>
                    <div id="p_val_str" class="row">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="tea_id">Volume</label>
                        <input type="number" name="p_vol" id="p_vol" class="form-control" placeholder="Enter Volume"
                            onchange="mul_rec2(this);">
                    </div>
                    <div id="p_val_vol" class="row">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="tea_id">Count</label>
                        <input type="number" name="p_count" id="p_count" class="form-control" placeholder="Enter Count" onchange="mul_rec3(this);">
                    </div>
                    <div id="p_val_count" class="row">
                    </div>
                    <div class="text-center">
                        <a id="tbl_g_entry" class="btn btn-info btn-lg" style="margin-right:10px;">Submit</a>
                        <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="dyn_tbl">
</div>


@endsection

@section('custom_js')
<script src="{{ url('/') }}/assets/js/lib/jquery2.min.js"></script>
<script>
    $("#urlhide").click(function (e) {
        e.preventDefault();
        // window.location.replace("https://www.google.com");
        window.open("https://www.google.com","_blank");
    });

    $('#tbl_g_entry').click(function (e) {
        e.preventDefault();

     var strval = $("input[name='mul_rec_str[]']")
    .map(function() {
    return $(this).val();
    }).get();

    var volval = $("input[name='mul_rec_vol[]']")
    .map(function() {
    return $(this).val();
    }).get();

    var countval = $("input[name='mul_rec_count[]']")
    .map(function() {
    return $(this).val();
    }).get();

        var str = $('#p_strength').val();
        var vol = $('#p_vol').val();
        var count = $('#p_count').val();
        var mul = parseInt(str)*parseInt(vol)*parseInt(count);
        var url = "{{route('admin.add_product')}}";
        var p_name = $('#p_name').val();
        var p_id = $('#p_id').val();
        var p_form = $('#p_form').val();
        var d_id = $("input[name='d_name[]']:checked")
            .map(function() {
            return $(this).val();
            }).get();

        var d_id2 = d_id.join(',');
        var d_id3 = d_id2+',';

        var volval2 = volval.join(',')+','

        var str_val = new Array(mul/strval.length).fill(strval).flat();
        var vol_val = new Array(mul/volval.length).fill(volval).flat();
        var sorted_vol_val = vol_val.sort();
        var count_val = new Array(mul/countval.length).fill(countval).flat();

        var data = "";
        var header = `<thead>
                        <tr>
                            <th style="width: 10%;" class="text-center">Sl. No.</th>
                            <th style="width: 15%;" class="text-center">Strength</th>
                            <th style="width: 15%;" class="text-center">Volume</th>
                            <th style="width: 20%;" class="text-center">Count</th>
                            <th style="width: 15%;" class="text-center">Price (in ₹)</th>
                            <th style="width: 25%;" class="text-center">Retail Price(in ₹)</th>
                        </tr>
                    </thead>`;
        var upper_header = `<form action="${url}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" value="${p_id}" name="p_id">
        <input type="hidden" value="${p_name}" name="p_name">
        <input type="hidden" value="${p_form}" name="p_form">
        <input type="hidden" value="${d_id3}" name="d_id">
        <input type="hidden" value="${volval2}" name="vol">

        <div class="block block-rounded">
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                    <tbody>`;
        var footer = `</tbody>
                </table>
            </div>
            <div class="text-center mb-2">
                <button type="submit" class="btn btn-info btn-lg">Submit</button>
                <button type="reset" class="btn btn-danger btn-lg">Reset</button>
            </div>
        </div>
    </div>
    </form>`;
    data = data + upper_header;
    var i = 0, c = 0;
    for(i = 0, c = 1; i<mul; i++,c++)
    {

        data = data + '<tr>';
        data = data + '<td>';
        data = data + c;
        data = data + '</td>';
        data = data + '<td>';
        data = data + `<div class="col-md-12 mb-3">
                        <label class="form-label">Product Strength</label>
                        <input type="hidden" name="strenhide[]" value="${str_val[i]}" placeholder="Enter Strength" class="form-control" readonly>
                        <input type="text" name="stren[]" value="${str_val[i]}" placeholder="Enter Strength" class="form-control" readonly disabled>
                    </div>`;
        data = data + '</td>';
        data = data + '<td>';
        data = data + `<div class="col-md-12 mb-3">
                        <label class="form-label">Volume</label>
                        <input type="hidden" name="volhide[]" value="${sorted_vol_val[i]}" placeholder="Enter Strength" class="form-control" readonly>
                        <input type="text" name="vol[]" value="${sorted_vol_val[i]}" placeholder="Enter Volume" class="form-control"  readonly disabled>
                    </div>`;
        data = data + '</td>';
        data = data + '<td>';
        data = data + `<div class="col-md-12 mb-3">
                        <label class="form-label">Count</label>
                        <input type="hidden" name="counthide[]" value="${count_val[i]}" placeholder="Enter Strength" class="form-control" readonly>
                        <input type="text" name="count[]" value="${count_val[i]}" placeholder="Enter Count" class="form-control"  readonly disabled>
                    </div>`;
        data = data + '</td>';
        data = data + '<td>';
        data = data + `<div class="col-md-12 mb-3">
                        <label class="form-label">Product Price</label>
                        <input type="text" name="price[]" placeholder="Enter Price" class="form-control">
                    </div>`;
        data = data + '</td>';
        data = data + '<td>';
        data = data + `<div class="col-md-12 mb-3">
                        <label class="form-label">Retail Price</label>
                        <input type="text" name="r_price[]" placeholder="Enter Retail Price" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Company 1</label>
                        <input type="text" name="c_1[]" placeholder="Enter Retail Price of Company 1" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Company 2</label>
                        <input type="text" name="c_2[]" placeholder="Enter Retail Price of Company 2" class="form-control">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Company 3</label>
                        <input type="text" name="c_3[]" placeholder="Enter Retail Price of Company 3" class="form-control">
                    </div>`;
        data = data + '</td>'
        data = data + '</tr>';
    }
    data = data + header;
    data = data + footer;

    $('#dyn_tbl').html(data);
    });

    function mul_rec1(e) {
        var count = $('#p_strength').val();
        var data1 = "";
        var n = 0;
        for(n = 1; n<=count; n++)
        {
            data1 = data1 + `<div class="col-md-4"><input type="text" class="form-control mb-2" placeholder="Enter Value ${n}" name="mul_rec_str[]"></div>`;
        }
        $('#p_val_str').html(data1);
    }

    function mul_rec2(e) {
        var count = $('#p_vol').val();
        var data2 = "";
        var n = 0;
        for(n = 1; n<=count; n++)
        {
            data2 = data2 + `<div class="col-md-4"><input type="text" class="form-control mb-2" placeholder="Enter Value ${n}" name="mul_rec_vol[]"></div>`;
        }
        $('#p_val_vol').html(data2);
    }

    function mul_rec3(e) {
            var count = $('#p_count').val();
            var data3 = "";
            var n = 0;
            for(n = 1; n<=count; n++)
            {
                data3 = data3 + `<div class="col-md-4"><input type="text" class="form-control mb-2" placeholder="Enter Value ${n}" name="mul_rec_count[]"></div>`;
            }
            $('#p_val_count').html(data3);
        }
</script>
@endsection
