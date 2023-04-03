<style>
    .sizing {
        font-size: 60px;
    }
</style>

@if (sizeof($x) == 0)
    <div class="bg-image" style="background-image: url('{{ url('/') }}/assets/media/photos/photo10@2x.jpg');">
        <div class="bg-primary-dark-op">
            <div class="content content-full text-center">
                <h1 class="text-danger text-white">No Records Found</h1>
            </div>
        </div>
    </div>
@else
    <div class="bg-image" style="background-image: url('{{ url('/') }}/assets/media/photos/photo10@2x.jpg');">
        <div class="bg-primary-dark-op">
            <div class="content content-full text-center">
                <div class="my-3">
                    @if ($x[0]->sys_logo == null)
                    <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ url('/') }}/assets/media/avatars/avatar13.jpg" alt="">
                    @else
                    <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{url('/storage')}}/schools/{{$x[0]->id}}/{{$x[0]->sys_logo}}" alt="">
                    @endif
                </div>
                <h1 class="h2 text-white mb-0">
                    {{ $x[0]->sys_name == null ? 'School Name' : $x[0]->sys_name }}
                </h1>
                <h3 class="text-white-75 mb-0">
                    {{ $x[0]->sys_add == null ? 'School Address' : $x[0]->sys_add }}
                </h3>
                <h4 class="fw-normal text-white-75 mb-1">
                    Contact No. {{ $x[0]->sys_contact1 == null ? 'XXXXXXXXXX' : $x[0]->sys_contact1 }}<br>
                    {{ $x[0]->sys_contact2 == null ? '' : $x[0]->sys_contact2 }}<br>
                    {{ $x[0]->sys_contact3 == null ? '' : $x[0]->sys_contact3 }}
                </h4>
                <h5 class="fw-normal text-white-75 mb-1"><i class="far fa-envelope"></i>
                    {{ $x[0]->sys_mail == null ? 'Not Provided' : $x[0]->sys_mail }}
                </h5>
                <h5 class="fw-normal text-white-75 mb-1">Website:
                    {{ $x[0]->sys_web_address == null ? 'Not Provided' : $x[0]->sys_web_address }}
                </h5>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 10%;">
                                <i class="far fa-user"></i>
                            </th>
                            <th style="width: 15%;">School Name</th>
                            <th style="width: 30%;">School Type</th>
                            <th style="width: 15%;">Governing Body</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($x as $key => $item)
                            <tr>
                                <td class="text-center">
                                    <img class="img-avatar img-avatar48"
                                        src="{{ url('/') }}/assets/media/avatars/avatar1.jpg" alt="">
                                </td>
                                <td class="fw-semibold fs-sm">
                                    <a href="#">{{ $item->sys_name }}</a>
                                </td>
                                <td class="fs-sm">{{ $item->sys_type }}</td>
                                <td>
                                    <span class="fs-xs fw-semibold">{{ $item->sys_body }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-alt-secondary"
                                            data-bs-toggle="tooltip" title="Edit">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-alt-secondary"
                                            data-bs-toggle="tooltip" title="Delete">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title text-center">Connect to Social Media</h3>
        </div>
        <div class="block-content">
            <div class="row mb-3">
                <div class="col-3 md-3">
                    <a href="#">
                        <i class="fab fa-linkedin me-1 sizing"></i>
                    </a>
                </div>
                <div class="col-3 md-3">
                    <a href="#">
                        <i class="fab fa-fw fa-twitter me-1 sizing"></i>
                    </a>
                </div>
                <div class="col-3 md-3">
                    <a href="#">
                        <i class="fab fa-fw fa-facebook me-1 sizing"></i>
                    </a>
                </div>
                <div class="col-3 md-3">
                    <a href="#">
                        <i class="fab fa-fw fa-instagram me-1 sizing"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endif
