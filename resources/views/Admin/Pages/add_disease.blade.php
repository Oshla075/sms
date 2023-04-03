@extends('Admin.Layout.main')

@section('title')
<title>Add Disease</title>
@endsection

@section('main_section')

<div class="card p-4 mb-3 mt-3 w-50" style="margin-left: 20%;">
    <div class="text-center card-header heading">
        <h1>Add Disease</h1>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                {{-- md= medium device, sm= small device, xs= extra small, xl= extra large --}}
                <form class="row" method="post" action="{{route('admin.insert_disease')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="col-md-12 mb-3">
                        <label class="form-label" for="d_name">Enter Disease Name</label>
                        <input type="text" name="d_name" id="d_name" class="form-control"
                            placeholder="Enter Disease Name">
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
