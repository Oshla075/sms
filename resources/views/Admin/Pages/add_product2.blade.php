@extends('Admin.Layout.main')

@section('title')
<title>Add Product 2</title>
@endsection

@section('main_section')

<div class="card p-4 mb-3 mt-3 w-50" style="margin-left: 20%;">
    <div class="text-center card-header heading">
        <h1>Add Product 2</h1>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {{-- md= medium device, sm= small device, xs= extra small, xl= extra large --}}
                <form class="row" method="post" action="" enctype="multipart/form-data">
                    @csrf
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
                        {{-- @foreach ($product_form as $key => $item)
                        <option value="{{ $item->id }}">{{ $item->p_form}}</option>
                        @endforeach --}}
                    </select>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="tea_id">Product Strength</label>
                        <input type="number" name="p_strength" id="p_strength" class="form-control"
                            placeholder="Enter Strength">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="tea_id">Volume</label>
                        <input type="number" name="p_vol" id="p_vol" class="form-control" placeholder="Enter Volume">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="tea_id">Count</label>
                        <input type="number" name="p_count" id="p_count" class="form-control" placeholder="Enter Count">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="p_price">Price</label>
                        <input type="number" name="p_price" id="p_price" class="form-control" placeholder="Enter Count">
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

@endsection
