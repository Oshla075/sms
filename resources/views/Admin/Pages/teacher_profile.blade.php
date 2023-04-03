<div class="bg-image mb-3" style="background-image: url('{{ url('/') }}/assets/media/photos/photo12@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full text-center text-white">
            <h1 class="fs-xl"><u>Teacher {{$data[0]->t_name}}'s Profile</u></h1>
            <div class="my-2 mb-3">
                @if ($data[0]->t_photo == null)
                <img class="img-avatar img-avatar-thumb" src="{{ url('/') }}/assets/media/avatars/avatar13.jpg" alt="">
                @else
                <img class="img-avatar img-avatar-thumb"
                    src="{{url('/storage')}}/teachers/{{$data[0]->t_id}}/{{$data[0]->t_photo}}"
                    style="width: 200px !important; height: 200px !important;" alt="">
                @endif
            </div>
            @php
            use Carbon\Carbon;
            $new_dob = Carbon::createFromFormat('d/m/Y', $data[0]->t_dob)->format('Y/m/d');
            $years = Carbon::parse($new_dob)->diff(Carbon::now());
            @endphp
            <div class="table-responsive ">
                <table class="table table-bordered table-vcenter">
                    <tbody class="text-white fw-semibold">
                        <tr>
                            <td>ID</td>
                            <td>{{$data[0]->t_id}}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{$data[0]->t_name}}</td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>{{$data[0]->t_gender}}</td>
                        </tr>
                        <tr>
                            <td>Aadhaar No.</td>
                            <td>{{$data[0]->t_adh_no}}</td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td>{{$data[0]->t_dob}}</td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td>{{$years->y}} years</td>
                        </tr>
                        <tr>
                            <td>Contact No.</td>
                            <td>{{$data[0]->t_contact}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
