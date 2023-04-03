{{-- @php
    // dd($t['TEA202303000001'][0]);
    foreach ($t as $key => $value) {
       if(sizeof($value)>1){
            print_r('2');
            echo "<br>";
       }
       elseif (sizeof($value)==1) {
        # code...
        print_r('1');
            echo "<br>";
       }
    }
@endphp --}}


@extends('Admin.Layout.main')

@section('title')
<title>View Teacher</title>
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
<div class="container">
    <h1 class="text-center heading">View Teacher</h1>
    <div class="row">
        <div class="col">
            @if (sizeof($t)==0)
            <div class="card">
                <div class="card-header">
                    <div class="card-title mt-4">
                        <h1 class="text-danger text-center">No Records Found</h1>
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
                                    <th style="width: 10%;" class="text-center">Teacher ID</th>
                                    <th style="width: 25%;" class="text-center">Teacher Name</th>
                                    <th style="width: 15%;" class="text-center">Sp. Subject</th>
                                    <th style="width: 20%;" class="text-center">Main. Subject</th>
                                    <th style="width: 20%;" class="text-center">Optional Subject</th>
                                    <th style="width: 10%;" class="text-center">Class Assign</th>
                                    {{-- <th style="width: 30%;" class="text-center">Teacher ID</th>

                                    <th style="width: 30%;" class="text-center">Sp. Subject</th>
                                    <th class="text-center" style="width: 100px;">Actions</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($t as $key => $value)
                                <tr>
                                    <td class="fw-semibold fs-sm text-center">
                                        {{$key}}
                                    </td>
                                    <td class="fw-semibold fs-sm text-center">
                                        {{$value[0]->t_name}}
                                    </td>
                                    <td class="fw-semibold fs-sm text-center">
                                        {{ $value[0]->sub_name}}
                                    </td>
                                    <td class="fw-semibold fs-sm text-center">
                                        @foreach ($value as $item)
                                            <span class="text-info">{{$item->sub_code}}</span><br>
                                        @endforeach
                                    </td>
                                    <td class="fw-semibold fs-sm text-center">
                                        @if($value[0]->op_sub == null)
                                            <span class="text-danger">No Subjects Assigned</span>
                                        @else
                                            @php
                                            $op = array();
                                            $sub = Str::substr($value[0]->op_sub,0,Str::length($value[0]->op_sub)-1);
                                            $op = explode(',',$sub);//6,7
                                            // print_r($op);
                                        @endphp
                                        @foreach ($subject as $sub)
                                            @foreach ($op as $s)
                                                @if($s==$sub->id)
                                                {{$sub->sub_code}}<br>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-alt-secondary" data-bs-toggle="modal"
                                            data-bs-target="#t_cls_modal{{ $key }}" title="Assign Class and Section for {{$value[0]->t_name}}">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                    </td>
                                    @include('Admin.Pages.modals.t_cls_assign_modal')
                                </tr>
                                @endforeach

                                {{-- @foreach ($t as $key => $item)
                                <tr>
                                    <td class="fw-semibold fs-sm text-center">
                                        {{++$key}}
                                    </td>
                                    <td class="fw-semibold fs-sm text-center">
                                        <a href="#">{{ $item->t_id}}</a>
                                    </td>
                                    <td class="fw-semibold fs-sm text-center">
                                        <a href="#">{{ $item->t_name}}</a>
                                    </td>
                                    <td class="fw-semibold fs-sm text-center">
                                        {{ $item->sub_name}}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{url('admin/teacher/edit/')}}/{{$item->t_id}}/" class="btn btn-sm btn-alt-secondary" title="Edit"><i class="fa fa-fw fa-pencil-alt"></i></a>
                                            <button type="button" class="btn btn-sm btn-alt-secondary"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <i class="fa fa-fw fa-times"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach --}}
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
<script src="{{ url('/') }}/assets/js/lib/jquery2.min.js"></script>
<script>
    $(document).ready(function() {
            $('#other').hide();
        });

        function id_reset(e) {
            e.preventDefault();

            $('#g_card_no').val('');
            $('#other').hide();
            $('#id_card_sts').html('');
        }

        function adr_chk(event) {

            var x = $('#id_type option:selected').val();
            var len;
            if(x == 'voterid')
            {
                len = 10;
            }
            else if(x == 'aadhaar')
            {
                len = 12;
            }
            else if(x == 'pan')
            {
                len = 10;
            }

            var c = $('#g_card_no').val().trim();
            var fd={
                'g_v_doc':x,
                'adh_no':c
            };
            var url = "{{ route('admin.chk_any2') }}";
            if(c.length == len)
                {
                    $('#id_card_sts').html('');
                    $.ajax({
                    type: "get",
                    url: url,
                    data: {
                        'f_n': JSON.stringify(fd),
                        't_n': 'guardians',
                    },
                    dataType: "JSON",
                    success: function(response) {
                        console.log(response);
                        if (response == 0) {
                            $('#other').show();

                        } else {
                            $('#id_card_sts').html(x+' No. Already Exists!');
                            $('#other').hide();
                        }
                    }
                });
                }
                else if(c.length == 0)
                {
                    $('#id_card_sts').html('');
                    $('#other').hide();
                }
                else
                {
                    $('#id_card_sts').html(x+' must be '+len+' digits.<br>You have entered '+c.length+' digits.');
                    $('#other').hide();
                }
        }

        function pin_chk(event) {
            var p = $('#g_pin').val();
            if(p.length == 0)
            {
                $('#pin_sts').html('');
            }
            else
            {
                if(p.length < 6)
                {
                $('#pin_sts').html('PIN Code must be 6 digits.<br>You have entered '+p.length+' digits.');
                }
                else
                {
                $('#pin_sts').html('');
                }
            }
        }

        function delguardian(sel,id) {
        var id = $(sel).attr('id');


        Swal.fire({
        title: 'Are you sure you want to Delete this Guardian?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
            title: 'Provide Password to Delete Record',
            html: `<input type="password" id="password" class="swal2-input" placeholder="Password">`,
            confirmButtonText: 'Proceed',
            focusConfirm: false,
            showCancelButton: true,
            preConfirm: () => {
            const password = Swal.getPopup().querySelector('#password').value
            if (password != '123') {
            Swal.showValidationMessage(`Please enter a valid password`)
            }
            return {password: password }
            }
            }).then((result) => {
            if (result.isConfirmed){
            $.ajax({
            type: "get",
            url: "{{route('admin.guardian.delete')}}",
            data: {
            'id':id
            },
            dataType: "JSON",
            success: function (response) {
            Swal.fire(
            'Deleted!',
            'Guardian Record Deleted Successfully',
            'success'
            )
            window.location.reload();
            }
            });
            }
            })
        }
        })
        }
</script>
@endsection --}}
