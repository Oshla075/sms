@extends('Admin.Layout.main')

@section('title')
<title>View Students</title>
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
{{-- {{dd($qu)}} --}}
@php
    $type = 'students';
    $table = 'students';
    $find_field = 'student_id';
    $update_field = 's_photo';
@endphp
{{-- {{dd($qu)}} --}}
<div class="container">
    <h1 class="text-center heading">View Students</h1>
    <div class="row">
        <div class="col">
            @if (sizeof($data)==0 || $section == null)
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
                                    <th style="width: 8%;" class="text-center fs-lg">Image</th>
                                    <th style="width: 20%;" class="text-center fs-lg">Student Details</th>
                                    <th style="width: 30%;" class="text-center fs-lg">Guardian Details</th>
                                    <th class="text-center fs-lg" style="width: 15%;">Student Fees</th>
                                    <th class="text-center fs-lg" style="width: 5%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $key => $item)
                                <tr>
                                    <td class="text-center">
                                        @php
                                            $g_id = $item->student_id;
                                        @endphp
                                        @if ($item->s_photo == null)
                                        <button type="button" class="btn btn-sm btn-alt-secondary"
                                        data-bs-toggle="modal" data-bs-target="#g_edit_modal{{$g_id}}" title="Edit Image">
                                             <img src="{{url('/')}}/assets/media/avatars/avatar13.jpg" alt=""  class="img-avatar img-avatar-thumb">
                                        </button>
                                        @else
                                        <button type="button" class="btn btn-sm btn-alt-secondary"
                                        data-bs-toggle="modal" data-bs-target="#g_edit_modal{{$g_id}}" title="Edit Image">
                                             <img src="{{url('/storage')}}/students/{{$g_id}}/{{$item->s_photo}}" alt=""  class="img-avatar img-avatar-thumb">
                                       </button>
                                        @endif
                                        @include('Admin.Pages.modals.g_photo_edit_modal')
                                    </td>
                                    <td class="fw-semibold">
                                        ID:&nbsp;<a href="#">{{ $item->student_id}}</a><br>
                                        Student Name:&nbsp;{{ $item->s_name}}<br>
                                        Section:&nbsp;{{ $item->sec_name}}<br>
                                        Contact No.:&nbsp;{{ $item->s_contact}}<br>
                                        Aadhaar No.:&nbsp;{{ $item->adh_no}}
                                    </td>
                                    <td class="fw-semibold">
                                        Guardian Name:&nbsp;<a href="#">{{$item->g_name}}</a><br>
                                        Guardian Contact No.:&nbsp;{{$item->g_contact_1}}<br>
                                        Guardian Address:&nbsp;{{$item->g_address}},&nbsp;P.O.:&nbsp;{{$item->g_post_office}},&nbsp;PIN-{{$item->g_pin_code}}<br>
                                        Guardian Aadhaar No.:&nbsp;{{$item->adh_no}}
                                    </td>
                                    <td class="fw-semibold">
                                        Registration Fees:&nbsp;{{$item->s_r_fees == null ? 'Not Provided': '₹ '.$item->s_r_fees}}<br>
                                        Tution Fees:&nbsp;{{$item->s_t_fees == null ? 'Not Provided': '₹ '.$item->s_t_fees}}<br>
                                        Other Fees:&nbsp;{{$item->s_o_fees == null ? 'Not Provided': '₹ '.$item->s_o_fees}}
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group">
                                            <a href="{{url('/admin/student/edit/')}}/{{$item->student_id}}/{{$qu}})'}}" class="btn btn-success btn-sm"><i class="fa fa-fw fa-pencil-alt"></i>&nbsp;Edit</a>&nbsp;
                                            {{-- <a href="{{url('/admin/student/delete/')}}/{{$item->student_id}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Student?')"><i class="fa fa-fw fa-trash"></i>&nbsp;Delete</a> --}}
                                            <button onclick="delstudent(this);" class="btn btn-danger btn-sm" id="{{$item->student_id}}"><i class="fa fa-fw fa-trash"></i>&nbsp;Delete</button>
                                        </div>
                                    </td>
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

@section('custom_js')
<script src="{{ url('/') }}/assets/js/lib/jquery2.min.js"></script>
<script>
    $(document).ready(function() {
            $('#other').hide();
        });

    function delstudent(sel,id) {
        var id = $(sel).attr('id');

        Swal.fire({
        title: 'Are you sure you want to Delete this Student?',
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
            url: "{{route('admin.student.delete')}}",
            data: {
            'id':id
            },
            dataType: "JSON",
            success: function (response) {
            Swal.fire(
            'Deleted!',
            'Student Record Deleted Successfully',
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
@endsection
