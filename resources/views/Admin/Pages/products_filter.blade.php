@extends('Admin.Layout.main')

@section('title')
<title>Filter Product</title>
@endsection

@section('main_section')
<div class="container py-2 mb-3">
    <div class="row">
        <div class="card col-6">
            <img src="#" alt="">
        </div>
        <div class="card col-6">
            <h1 id="price"></h1>
            <span id="r_price" style="text-decoration:line-through;"></span>
            <form method="get" action="#" enctype="multipart/form-data" class="row">
                <input type="hidden" id="pro_id" name="pro_id" value="{{$p[0]->id}}">
                <input type="hidden" id="pro_str" name="pro_str" >
                <input type="hidden" id="pro_vol" name="pro_vol" >
                <input type="hidden" id="pro_count" name="pro_count" >
                <div class="col-md-12">
                    @foreach ($strength as $key => $value1)
                    @if ($value1->strength != null)
                    <input class="form-check-input" type="radio" value="{{$value1->strength}}"
                        id="str" name="str">
                    <label class="form-check-label" for="p_v{{$key}}">Strength {{$value1->strength}}</label>
                    @endif
                    @endforeach
                </div>
                <div class="col-md-12">
                    @foreach ($volume as $key => $value2)
                    @if ($value2->volume != null)
                    <input  class="form-check-input" type="radio" value="{{$value2->volume}}"
                        id="vol" name="vol">
                    <label class="form-check-label" for="p_v{{$key}}">Volume {{$value2->volume}}</label>
                    @endif
                    @endforeach
                </div>
                <div class="col-md-12">
                    @foreach ($count as $key => $value3)
                    @if ($value3->count != null)
                    <input  class="form-check-input" type="radio" value="{{$value3->count}}"
                        id="count" name="count">
                    <label class="form-check-label" for="p_v{{$key}}">Count {{$value3->count}}</label>
                    @endif
                    @endforeach
                </div>
                <div class="text-center mb-2 mt-2">
                    <button type="submit" class="btn btn-info btn-lg">Submit</button>
                    <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('custom_js')
<script src="{{ url('/') }}/assets/js/lib/jquery2.min.js"></script>
<script>
        $(document).ready(function () {
            var str=0;
            var vol=0;
            var count=0;
            var p_id = $('#pro_id').val();
            radioCheck();


            $('input[type=radio][name=str]').change(function() {
                str = this.value;
                $('#pro_str').val(str);

                // console.log(str);
                var vol=null;
                if($("#vol").length != 0) {
                    var vol = document.getElementById("vol").value;
                }
                var count = document.getElementById("count").value;
                console.log('Str = '+str);
                console.log('Vol = '+vol);
                console.log('Count = '+count);
                get_price();
            });

            $('input[type=radio][name=vol]').change(function() {
                vol = this.value;
                // console.log(vol);
                $('#pro_vol').val(vol);
                var vol = document.getElementById("str").value;
                var count = document.getElementById("count").value;
                console.log('Str = '+str);
                console.log('Vol = '+vol);
                console.log('Count = '+count);
                get_price();
            });

            $('input[type=radio][name=count]').change(function() {
                count = this.value;
                // console.log(count);
                $('#pro_count').val(count);

                var str = document.getElementById("str").value;
                var vol=null;
                if($("#vol").length != 0) {
                    var vol = document.getElementById("vol").value;
                }
                console.log('Str = '+str);
                console.log('Vol = '+vol);
                console.log('Count = '+count);
                get_price();
            });
            // $('input[type=radio][name=vol]').change(function() {
            //     vol = this.value;
            //     console.log(vol);
            //     get_price(str,vol,count);
            // });

            // $('input[type=radio][name=count]').change(function() {
            //     count = this.value;
            //     console.log(count);
            //     get_price(str,vol,count);
            // });
        });



        function getval(str,vol,count)
        {
            console.log("addition is "+(parseInt(str)+parseInt(vol)+parseInt(count)));
        }

        function radioCheck()
        {
            // var p_id = $('#pro_id').val();
            var str = document.getElementById("str").value;
            $("input[name=str][value=" + str + "]").prop('checked', true);
            $('#pro_str').val(str);

            var vol=null;
            if($("#vol").length != 0) {
                var vol = document.getElementById("vol").value;
                $("input[name=vol][value=" + vol + "]").prop('checked', true);
                $('#pro_vol').val(vol);
            }

            var count = document.getElementById("count").value;
            $("input[name=count][value=" + count + "]").prop('checked', true);
            $('#pro_count').val(count);

            get_price();
        }

        function get_price() {
            var p_id = $('#pro_id').val();
            var str = $('#pro_str').val();
            var vol = $('#pro_vol').val();
            var count = $('#pro_count').val();
            console.log(p_id);

        var fd={
            'p_id':p_id,
            'strength':str,
            'volume':vol,
            'count':count

        };
        var url = "{{ route('admin.get_any2') }}";

            $.ajax({
            type: "get",
            url: url,
            data: {
                'f_n': JSON.stringify(fd),
                't_n': 'products_details',
            },
            dataType: "JSON",
            success: function(response) {
                console.log(response);
                if(response.length != 0)
                {
                    $('#price').html(response[0].price);
                    $('#r_price').html(response[0].r_price);
                }
                else
                {
                    $('#price').html("Price Not Set");
                }
            }
        });
    }

</script>
@endsection
