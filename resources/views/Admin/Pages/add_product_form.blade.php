@extends('Admin.Layout.main')

@section('title')
<title>Add Product Form</title>
@endsection

@section('main_section')

<div class="card p-4 mb-3 mt-3 w-50" style="margin-left: 20%;">
    <div class="text-center card-header heading">
        <h1>Add Product Form</h1>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {{-- md= medium device, sm= small device, xs= extra small, xl= extra large --}}
                <form class="row" method="post" action="{{route('admin.insert_p_form')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="p_form">Enter Product Form</label>
                        <input type="text" name="p_form" id="p_form" class="form-control"
                            placeholder="Enter Product Form">
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
