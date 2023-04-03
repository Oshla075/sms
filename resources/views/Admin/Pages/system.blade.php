@extends('Admin.Layout.main')

@section('title')
    <title>School System</title>
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
        <h1 class="text-center heading">School System</h1>
        <div class="row">
            <div class="col-6">
                @if (sizeof($x) == 0)
                    <form method="post" action="{{ route('admin.system.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">School Name</label>
                            <input type="text" name="s_name" class="form-control" id="s_name"
                                placeholder="Enter School Name" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">School Address</label>
                            <textarea rows="3" placeholder="Enter School Address" name="s_add" class="form-control" id="s_add"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">School Contact No.</label>
                            <input type="number" name="s_contact1" class="form-control" onkeypress="limitKeypress(event,this.value,10)" id="s_contact1"
                                placeholder="School Contact No. 1" aria-describedby="emailHelp"><br>
                            <input type="number" name="s_contact2" class="form-control" onkeypress="limitKeypress(event,this.value,10)" id="s_contact2"
                                placeholder="School Contact No. 2" aria-describedby="emailHelp"><br>
                            <input type="number" name="s_contact3" class="form-control" onkeypress="limitKeypress(event,this.value,10)" id="s_contact3"
                                placeholder="School Contact No. 3" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="s_type">School Type<span class="text-danger">*</span></label>
                            <select class="js-select2 form-select" id="s_type" name="s_type" style="width: 100%;"
                                data-placeholder="Choose one..">
                                <option></option>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="wbbse">WBBSE</option>
                                <option value="wbchse">WBCHSE</option>
                                <option value="wbsu">WBSU</option>
                                <option value="cbse">CBSE</option>
                                <option value="icse">ICSE</option>
                                <option value="isc">ISC</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Governing Body</label>
                            <input type="text" name="s_body" class="form-control" id="s_body"
                                placeholder="Enter Governing Body" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">School Email-ID</label>
                            <input type="email" name="s_mail" class="form-control" id="s_mail"
                                placeholder="Enter School Email-ID" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">School Web Address</label>
                            <input type="text" name="s_web_address" class="form-control" id="s_web_address"
                                placeholder="Enter School Web Address" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload School Logo</label>
                            <input type="file" class="form-control" name="s_logo" id="s_logo">
                            <div class="mt-2">
                                @if ($errors->has('s_logo'))
                                <span class="text-danger fw-semibold fs-sm">{{$errors->first('s_logo')}}</span>
                                @else
                                <span class="text-info fw-semibold fs-sm">Only JPG, PNG and JPEG formats are allowed.<br>File size must be in 20 KB.</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">School Social Media Link</label>
                            <input type="text" name="s_social_link" class="form-control" id="s_social_link"
                                placeholder="Enter School Social Media Link" aria-describedby="emailHelp">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            <button type="reset" class="btn btn-danger btn-lg">Reset</button>
                        </div>
                    </form>
                @else
                    <form method="post" action="{{ route('admin.system.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <input type="hidden" name="s_id" value="{{ $x[0]->id }}">
                            <input type="hidden" name="update_field" value="sys_logo">
                            <label class="form-label">School Name</label>
                            <input type="text" value="{{ $x[0]->sys_name == null ? '' : $x[0]->sys_name }}"
                                name="s_name" class="form-control" id="s_name" placeholder="Enter School Name"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">School Address</label>
                            <textarea rows="3" placeholder="Enter School Address" name="s_add" class="form-control" id="s_add">{{ $x[0]->sys_add == null ? '' : $x[0]->sys_add }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">School Contact No.</label>
                            <input type="number" value="{{ $x[0]->sys_contact1 == null ? '' : $x[0]->sys_contact1 }}"
                                name="s_contact1" class="form-control" onkeypress="limitKeypress(event,this.value,10)" id="s_contact1"
                                placeholder="School Contact No. 1" aria-describedby="emailHelp"><br>
                            <input type="number" value="{{ $x[0]->sys_contact2 == null ? '' : $x[0]->sys_contact2 }}"
                                name="s_contact2" class="form-control" onkeypress="limitKeypress(event,this.value,10)" id="s_contact2"
                                placeholder="School Contact No. 2" aria-describedby="emailHelp"><br>
                            <input type="number" value="{{ $x[0]->sys_contact3 == null ? '' : $x[0]->sys_contact3 }}"
                                name="s_contact3" class="form-control" onkeypress="limitKeypress(event,this.value,10)" id="s_contact3"
                                placeholder="School Contact No. 3" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="s_type">School Type<span
                                    class="text-danger">*</span></label>
                            <select class="js-select2 form-select" id="s_type" name="s_type" style="width: 100%;"
                                data-placeholder="Choose one..">
                                <option></option>
                                <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="wbbse" {{ $x[0]->sys_type == 'wbbse' ? 'selected' : '' }}>WBBSE</option>
                                <option value="wbchse" {{ $x[0]->sys_type == 'wbchse' ? 'selected' : '' }}>WBCHSE</option>
                                <option value="wbsu" {{ $x[0]->sys_type == 'wbsu' ? 'selected' : '' }}>WBSU</option>
                                <option value="cbse" {{ $x[0]->sys_type == 'cbse' ? 'selected' : '' }}>CBSE</option>
                                <option value="icse" {{ $x[0]->sys_type == 'icse' ? 'selected' : '' }}>ICSE</option>
                                <option value="isc" {{ $x[0]->sys_type == 'isc' ? 'selected' : '' }}>ISC</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Governing Body</label>
                            <input type="text" value="{{ $x[0]->sys_body == null ? '' : $x[0]->sys_body }}"
                                name="s_body" class="form-control" id="s_body" placeholder="Enter Governing Body"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">School Email-ID</label>
                            <input type="email" value="{{ $x[0]->sys_mail == null ? '' : $x[0]->sys_mail }}"
                                name="update_s_mail" onchange="mail_check(this);" class="form-control"
                                id="update_s_mail" placeholder="Enter School Email-ID" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">School Web Address</label>
                            <input type="text"
                                value="{{ $x[0]->sys_web_address == null ? '' : $x[0]->sys_web_address }}"
                                name="s_web_address" class="form-control" id="s_web_address"
                                placeholder="Enter School Web Address" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload School Logo</label>
                            <input type="file" value="{{ $x[0]->sys_logo == null ? '' : $x[0]->sys_logo }}"
                                class="form-control" name="s_logo" id="s_logo">
                            <div class="mt-2">
                                @if ($errors->has('s_logo'))
                                <span class="text-danger fw-semibold fs-sm">{{$errors->first('s_logo')}}</span>
                                @else
                                <span class="text-info fw-semibold fs-sm">Only JPG, PNG and JPEG formats are allowed.<br>File size must be in 20 KB.</span>
                                @endif
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">School Social Media Link</label>
                            <input type="text"
                                value="{{ $x[0]->sys_social_link == null ? '' : $x[0]->sys_social_link }}"
                                name="s_social_link" class="form-control" id="s_social_link"
                                placeholder="Enter School Social Media Link" aria-describedby="emailHelp">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg" id="disble">Edit Details</button>
                            <button type="reset" class="btn btn-danger btn-lg">Cancel</button>
                        </div>
                    </form>
                @endif
            </div>
            <div class="col-6">
                @include('Admin.Pages.profile')
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

        function mail_check(event) {
            var c = $('#update_s_mail').val();
            var url = "{{ route('admin.chk_any') }}";

            $.ajax({
                type: "get",
                url: url,
                data: {
                    'f_n': 'sys_mail',
                    't_n': 'systems',
                    'f_v': c
                },
                dataType: "JSON",
                success: function(response) {
                    // console.log(response);
                    if (response == 0) {
                        $('#disble').prop('disabled', false);
                    } else {
                        Swal.fire(
                            'Email ID Already Exists!',
                            '',
                            'warning'
                        )
                        $('#disble').prop('disabled', true);
                    }
                }
            });
        }
    </script>
@endsection
