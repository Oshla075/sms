@extends('Admin.Layout.main')

@section('title')
<title>Search Product</title>
@endsection

@section('main_section')
<div class="container py-2 mb-3">
    <form method="get" action="{{route('admin.product_details')}}" enctype="multipart/form-data">
        <div class="col-md-6">
            <label class="form-label" for="sub_id">Choose Product ID</label>
            <select class="js-select2 form-select" id="p_id" name="p_id" style="width: 100%;"
                data-placeholder="Choose one..">
                <option></option>
                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                @foreach ($products as $key => $item)
                <option value="{{ $item->id }}">{{ $item->p_id}}</option>
                @endforeach
            </select>
            <div class="text-center mb-2 mt-2">
                <button type="submit" class="btn btn-info btn-lg">Submit</button>
                <button type="reset" class="btn btn-danger btn-lg">Reset</button>
            </div>
        </div>
    </form>
</div>




@endsection

@section('custom_js')
<script src="{{ url('/') }}/assets/js/lib/jquery2.min.js"></script>

@endsection
