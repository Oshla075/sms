@extends('Admin.Layout.main')

@section('title')
    <title>Student Details</title>
@endsection

@section('main_section')
<style>
    .bg-body-light {
    background-color: #f6f7f9a1!important;
}
</style>

    <div class="content">
        <div class="d-flex flex-column flex-md-row justify-content-md-between align-items-md-center py-2 text-center text-md-start">
            <div class="flex-grow-1 mb-1 mb-md-0">
                <h1 class="h3 fw-bold mb-2">
                    Welcome
                </h1>
                <h2 class="h6 fw-medium fw-medium text-muted mb-0">
                    Welcome <a class="fw-semibold" href="#">John</a>, everything looks great.
                </h2>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row items-push">
            <div class="col-6 col-sm-6 col-xl-3">
                <div class="block block-rounded text-center bg-image"
                    style="background-image: url('{{url('/')}}/assets/media/photos/photo14.jpg');">
                    <div class="block-content block-content-full  ratio ratio-1x1">
                        <div class="d-flex justify-content-center align-items-center">
                            <div>
                                <div class="fs-1 fw-bold">32</div>
                                <div class="fw-semibold mt-3 text-uppercase">Academic Profile</div>
                                <div class="item item-rounded-lg mt-3 bg-light" style="margin-left: 50px!important;">
                                    <i class="far fa-user-circle fs-1 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-semibold d-flex align-items-center justify-content-between"
                            href="#">View all orders<i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-xl-3">
                <div class="block block-rounded text-center bg-image"
                    style="background-image: url('{{url('/')}}/assets/media/photos/photo25@2x.jpg');">
                    <div class="block-content block-content-full  ratio ratio-1x1">
                        <div class="d-flex justify-content-center align-items-center">
                            <div>
                                <div class="fs-1 fw-bold">32</div>
                                <div class="fw-semibold mt-3 text-uppercase">Qualification</div>
                                <div class="item item-rounded-lg mt-3 bg-light" style="margin-left: 50px!important;">
                                    <i class="far fa-user-circle fs-1 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-semibold d-flex align-items-center justify-content-between"
                            href="#">View all orders<i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-xl-3">
                <div class="block block-rounded text-center bg-image"
                    style="background-image: url('{{url('/')}}/assets/media/photos/photo37@2x.jpg');">
                    <div class="block-content block-content-full  ratio ratio-1x1">
                        <div class="d-flex justify-content-center align-items-center">
                            <div>
                                <div class="fs-1 fw-bold">32</div>
                                <div class="fw-semibold mt-3 text-uppercase">Exams</div>
                                <div class="item item-rounded-lg mt-3 bg-light" style="margin-left: 50px!important;">
                                    <i class="far fa-user-circle fs-1 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-semibold d-flex align-items-center justify-content-between"
                            href="#">View all orders<i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-6 col-xl-3">
                <div class="block block-rounded text-center bg-image"
                    style="background-image: url('{{url('/')}}/assets/media/photos/photo28@2x.jpg');">
                    <div class="block-content block-content-full  ratio ratio-1x1">
                        <div class="d-flex justify-content-center align-items-center">
                            <div>
                                <div class="fs-1 fw-bold text-light">32</div>
                                <div class="fw-semibold mt-3 text-uppercase text-light">Attendance Record</div>
                                <div class="item item-rounded-lg mt-3 bg-light" style="margin-left: 50px!important;">
                                    <i class="far fa-user-circle fs-1 text-primary"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-body-light rounded-bottom">
                        <a class="block-content block-content-full block-content-sm fs-sm fw-semibold d-flex align-items-center justify-content-between"
                            href="#"><span class="text-light">View all orders</span><i class="fa fa-arrow-alt-circle-right ms-1 opacity-25 fs-base"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- @section('custom_js')
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: 'Welcome'
        })
    </script>
@endsection --}}
