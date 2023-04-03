@extends('Admin.Layout.main')

@section('title')
    <title>Add Subject's Code</title>
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
    {{-- @php
        dd($x);
    @endphp --}}
    <div class="container">
        <h1 class="text-center heading">Add Subject's Code</h1>
        <div class="row">
            <div class="col-6">
                <form method="post" action="{{route('admin.subjects.create')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label" for="sub_name">Subject Name</label>
                        <select class="js-select2 form-select" id="sub_name" name="sub_name" style="width: 100%;"
                            data-placeholder="Choose one..">
                            <option></option>
                            <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                            @foreach ($y as $key => $item)
                            <option value="{{ $item->id }}">{{ $item->sub_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subject Code</label>
                        <input type="text" name="sub_code" class="form-control" id="sub_code"
                            placeholder="Enter Subject Code" aria-describedby="emailHelp">
                        <span id="sub_code_msg" class="text-danger"></span>
                    </div>
                    <div class="text-center" id="btn_group">
                        <button type="submit" class="btn btn-primary btn-lg" id="disble">Submit</button>
                        <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                    </div>
                </form>
            </div>
            <div class="col-6">
                @if (sizeof($s) == 0)
                    <div class="bg-image"
                        style="background-image: url('{{ url('/') }}/assets/media/photos/photo10@2x.jpg');">
                        <div class="bg-primary-dark-op">
                            <div class="content content-full text-center">
                                <h1 class="text-danger text-white">No Records Found</h1>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="block block-rounded">
                        <div class="block-content">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                                    <thead>
                                        <tr>
                                            <th style="width: 20%;" class="text-center">Sl. No.</th>
                                            <th style="width: 30%;" class="text-center">Subject Name</th>
                                            <th style="width: 30%;" class="text-center">Subject Code</th>
                                            <th class="text-center" style="width: 30%;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($s as $key => $item)
                                            <tr {{($item->sub_status == 0)? "class=text-danger":""}}>
                                                <td class="text-center">{{ ++$key }}</td>
                                                <td class="fw-semibold fs-sm text-center">
                                                    {{ $item->sub_name }}
                                                </td>
                                                <td class="fw-semibold fs-sm text-center">
                                                    {{ $item->sub_code }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-sm btn-alt-secondary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal-block-fadein{{ $key }}"
                                                            title="Edit">
                                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-sm btn-alt-secondary"
                                                            data-bs-toggle="tooltip" title="Delete">
                                                            <i class="fa fa-fw fa-times"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                {{-- @include('Admin.Pages.modals.class_edit_modal') --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
{{-- @section('custom_js')
    <script>
        $(document).ready(function() {
            // $('#btn_group').show();
            // $('#disble').css({'cursor':'not-allowed','pointer-event':'none'});
            $('#disble').prop('disabled', true);

        });

        function check_class(event) {
            var c = $('#c_name').val();
            var url = "{{ route('getClass') }}";
            if ($('#c_name').empty()) {
                $('#c_name_msg').html("");
                $('#disble').prop('disabled', true);
            }
            $.ajax({
                type: "get",
                url: url,
                data: {
                    'cls': c
                },
                dataType: "JSON",
                success: function(response) {
                    if (response == 0) {
                        //  $('#btn_group').show();
                        $('#c_name_msg').html("");
                        $('#disble').prop('disabled', false);
                    } else {
                        Swal.fire(
                            'Room No. Already Exists!',
                            '',
                            'error'
                        )
                        // $('#c_name_msg').html("Data Already Exists");
                        $('#disble').prop('disabled', true);
                        // $('#disble').css({'cursor':'not-allowed','pointer-event':'none'});
                    }

                }
            });
        }
    </script>
@endsection --}}
