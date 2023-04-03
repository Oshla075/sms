@extends('Admin.Layout.main')

@section('title')
<title>School Section</title>
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
    <h1 class="text-center heading">School Section</h1>
    <div class="row">
        <div class="col-6">
            <form method="post" action="{{route('admin.section.create')}}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Section Name</label>
                    <input type="text" name="sec_name" class="form-control" id="sec_name"
                        placeholder="Enter Section Name" aria-describedby="emailHelp">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="sec_class">Class</label>
                    <select class="js-select2 form-select" id="sec_class" name="sec_class" style="width: 100%;"
                        data-placeholder="Choose one.." onchange="sec_check(this);">
                        <option></option>
                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                        @foreach ($y as $key => $item)
                        <option value="{{ $item->id }}">{{ $item->c_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="sec_room">Room</label>
                    <select class="js-select2 form-select" id="sec_room" name="sec_room" style="width: 100%;"
                        data-placeholder="Choose one..">
                        <option></option>
                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                        @foreach ($x as $key => $item)
                        <option value="{{ $item->id }}">{{ $item->r_no }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg" id="disble">Submit</button>
                    <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                </div>
            </form>
        </div>
        <div class="col-6">
            <div class="block block-rounded">
                <div class="block-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                            <thead>
                                <tr>
                                    <th style="width: 30%;" class="text-center">Section Name</th>
                                    <th style="width: 20%;" class="text-center">Class</th>
                                    <th style="width: 20%;" class="text-center">Room</th>
                                    <th class="text-center" style="width: 100px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (sizeof($data)==0)
                                <tr>
                                    <td colspan="4" class="text-center text-danger">No records</td>
                                </tr>
                                @else
                                @foreach ($data as $key => $item)
                                <tr>
                                    <td class="fw-semibold fs-sm text-center">
                                        <a href="#">{{ $item->s_name }}</a>
                                    </td>
                                    <td class="text-center">
                                        <span class="fs-xs fw-semibold">{{ $item->c_name }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fs-xs fw-semibold">{{ $item->r_no }}</span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="modal" data-bs-target="#sectionModal{{ $item->id }}"
                                                title="Section & Class Edit">
                                                <i class="fa fa-fw fa-pencil-alt"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="modal" data-bs-target="#sectionRoomModal{{ $item->id }}"
                                                title="Room Edit">
                                                <i class="fa fa-fw si si-home"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                    @include('Admin.Pages.modals.section_edit_modal')
                                    @include('Admin.Pages.modals.section_edit_room_modal')
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('custom_js')
<script>
    $(document).ready(function() {
            // $('#btn_group').show();
            // $('#disble').css({'cursor':'not-allowed','pointer-event':'none'});
            $('#disble').prop('disabled', true);
        });

        function sec_check(event) {
            var s = $('#sec_name').val();
            var c = $('#sec_class').val();
            var url = "{{ route('admin.chk_any2') }}";

            //dictionary
            var fd={
                's_name':s,
                'c_id':c
            };
            // console.log(fd);
            $.ajax({
                type: "get",
                url: url,
                data: {
                    'f_n': JSON.stringify(fd),
                    't_n': 'sections',
                },
                dataType: "JSON",
                success: function(response) {
                    // console.log(response);
                    if (response == 0) {
                        $('#disble').prop('disabled', false);
                    } else {
                        Swal.fire(
                            'Section Name Already Exists!',
                            '',
                            'warning'
                        )
                        $('#disble').prop('disabled', true);
                        $("#sec_class").select2().val(null).trigger("change");
                        $('#sec_name').val("").focus();
                    }
                }
            });
        }
</script>
@endsection
