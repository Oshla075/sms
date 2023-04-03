@extends('Admin.Layout.main')

@section('title')
<title>Edit Teacher {{$data[0]->t_name}}</title>
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

    .btn .badge {
        position: relative;
        top: -15px !important;
        left: 16px !important;
    }
</style>
@section('main_section')
{{-- @php
$table = "guardians";
$find_field = "g_id";
$update_field = "g_doc";
$id = $data[0]->g_id;
$name = $data[0]->g_name;
$des_f = 'parents';
@endphp --}}
<div class="container">
    <h1 class="text-center heading">Edit Teacher {{$data[0]->t_name}}</h1>
    <div class="row">
        <div class="col-6">
            <div class="card mb-4 p-2">
                <div class="card-header bg-primary text-center">
                    <span class="fw-semibold fs-lg text-white">Edit Teacher Details</span>
                </div>
                <div class="card-body">
                    <div class="form-group bmd-form-group is-filled">
                        <form method="post" action="{{route('admin.teacher.update')}}"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="update_t_id" value="{{$data[0]->t_id}}">
                            <div class="mb-3">
                                <label class="form-label" for="update_t_card_no">Teacher Aadhaar No.</label>
                                <input type="number" name="update_t_card_no" class="form-control" id="update_t_card_no"
                                    placeholder="Enter Teacher's Aadhaar No." aria-describedby="emailHelp"
                                    onkeypress="limitKeypress(event,this.value,12)" value="{{$data[0]->t_adh_no}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Name of the Teacher</label>
                                <input type="text" name="update_t_name" class="form-control" id="update_t_name"
                                    placeholder="Enter Teacher's Name." aria-describedby="emailHelp"
                                    value="{{$data[0]->t_name}}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Guardian Gender</label>
                                <div class="space-x-6">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example1"
                                            name="update_t_gender" value="Male" {{ $data[0]->t_gender == 'Male' ?
                                        'checked' : '' }}>
                                        <label class="form-check-label" for="example1">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example2"
                                            name="update_t_gender" value="Female" {{ $data[0]->t_gender == 'Female' ?
                                        'checked' : '' }}>
                                        <label class="form-check-label" for="example2">Female</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" id="example3"
                                            name="update_t_gender" value="Others" {{ $data[0]->t_gender == 'Others' ?
                                        'checked' : '' }}>
                                        <label class="form-check-label" for="example3">Others</label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Teacher's Date of Birth</label>
                                <input type="text" class="js-datepicker form-control" id="update_t_dob" name="update_t_dob"
                                    data-week-start="1" data-autoclose="true" data-today-highlight="true"
                                    value="{{$data[0]->t_dob}}" data-date-format="dd/mm/yyyy"
                                    placeholder="Choose Date of Birth" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Teacher's Contact No.</label>
                                <input type="number" name="update_t_contact" class="form-control" maxlength="10"
                                    id="update_t_contact" placeholder="Enter Teacher's Contact No."
                                    aria-describedby="emailHelp" onkeypress="limitKeypress(event,this.value,10)"
                                    value="{{$data[0]->t_contact}}">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-lg" style="margin-right: 10px;"
                                    id="g_edit_btn">Submit</button>
                                <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- <div class="card mb-4 p-2">
                <div class="card-header bg-primary text-center">
                    <span class="fw-semibold fs-lg text-white">View Guardian Documents</span>
                </div>
                <div class="card-body">
                    <div class="form-group bmd-form-group is-filled">
                        <div class="mb-3">
                            @php
                            $b = array();
                            $sub = Str::substr($data[0]->g_doc,0,Str::length($query[0]->g_doc)-1);
                            $b = explode(',',$sub);
                            $d = ($b[(sizeof($b)-1)]);
                            $pos = (strrpos($d,'.')-1);
                            $sub_str = (int)substr($d,$pos,1);
                            @endphp
                            @if ($b[0]!="")
                            @foreach ($b as $key=>$item)
                            <a href="{{url('/storage')}}/parents/{{$query[0]->g_id}}/{{$item}}" target="_blank"
                                class="btn btn-primary btn-sm"
                                style="padding-right: 40px !important; margin-right: 20px;">{{++$key}}
                            </a>
                            <a href="{{url('/admin/multi_data_remove/')}}/{{$item}}/{{$query[0]->g_doc}}/{{$query[0]->g_id}}/g_id/g_doc/guardians/parents"
                                onclick="return confirm('Are you sure you want to delete this document?')"><span
                                    class="badge badge-danger"
                                    style="background-color: red !important; margin-left: -40px;"><i class="fa fa-fw fa-times"></i></span></a>
                            @endforeach
                            <div class="text-center mt-3"><button class="btn btn-success btn-lg" id="g_add_doc">Add Documents</button></div>
                            <div id="add_doc">
                                <form action="{{route('edit_multi_docs_2')}}" enctype="multipart/form-data" method="post">
                                    @csrf
                                    <input type="hidden" name="tb_name" value="{{$table}}">
                                    <input type="hidden" name="search_field" value="{{$find_field}}">
                                    <input type="hidden" name="goal_field" value="{{$update_field}}">
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Add More Documents</label>
                                        <input type="file" class="form-control" name="update_g_doc[]" id="update_g_doc"
                                            multiple>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                        <button class="btn btn-danger btn-lg" id="cncl_add_doc">Cancel</button>
                                    </div>
                                </form>
                            </div>
                            @else
                            <div class="text-center p-2 bg-danger"><span class="text-light fw-bold fs-lg">No Documents
                                    Found</span></div>
                            <div class="text-center mt-2"><button class="btn btn-success btn-lg" data-bs-toggle="modal"
                                    data-bs-target="#mul_doc_edit_modal{{$id}}">Add Documents</button></div>
                            @include('Admin.Pages.modals.multiple_doc_edit_modal')
                            @endif
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="col-6">
            @include('Admin.Pages.teacher_profile')
        </div>
    </div>
</div>
@endsection

