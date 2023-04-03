@extends('Admin.Layout.main')

@section('title')
<title>Class Fees Update</title>
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
    <h1 class="text-center heading">Class Fees Update</h1>
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
            <form method="post" class="row col-md-12 mb-3" action="{{route('admin.class_fees.create')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="aca_year">Year</label>
                    <select class="js-select2 form-select" id="aca_year" name="aca_year" style="width: 100%;"
                        data-placeholder="Choose one..">
                        <option></option>
                        @foreach ($date as $item)
                           <option value="{{ $item }}">{{ $item }} - {{ ++$item }}</option>
                        @endforeach
                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="s_class">Class</label>
                    <select class="js-select2 form-select" id="s_class" name="s_class" style="width: 100%;"
                        data-placeholder="Choose one..">
                        <option></option>
                        <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                        @foreach ($y as $key => $item)
                        <option value="{{ $item->id }}">{{ $item->c_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Registration Fees</label>
                    <input type="number" name="reg_fees" class="form-control" id="reg_fees"
                        placeholder="Enter Registration Fees" aria-describedby="emailHelp">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Tution Fees</label>
                    <input type="number" name="tut_fees" class="form-control" id="tut_fees"
                        placeholder="Enter Tution Fees" aria-describedby="emailHelp">
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Other Fees</label>
                    <input type="number" name="oth_fees" class="form-control" id="oth_fees"
                        placeholder="Enter Other Fees" aria-describedby="emailHelp">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-lg" id="disble">Submit</button>
                    <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                </div>
            </form>
        </div>
        {{-- <div class="col-md-6">
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
        </div> --}}
</div>
@endsection
@section('custom_js')
{{-- <script>
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
</script> --}}
@endsection
