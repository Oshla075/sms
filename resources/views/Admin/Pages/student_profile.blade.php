<div class="bg-image" style="background-image: url('{{ url('/') }}/assets/media/photos/photo28@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full text-center text-white">
            <h1 class="fs-xl"><u>Student {{$item[0]->s_name}}'s Profile</u></h1>
            <div class="my-2 mb-3">
                @if ($item[0]->s_photo == null)
                    <img class="img-avatar img-avatar-thumb" src="{{ url('/') }}/assets/media/avatars/avatar13.jpg"
                    alt="">
                @else
                <img class="img-avatar img-avatar-thumb" src="{{url('/storage')}}/students/{{$item[0]->student_id}}/{{$item[0]->s_photo}}" style="width: 200px !important; height: 200px !important;" alt="">
                @endif
            </div>
            @php
                use Carbon\Carbon;
                $new_dob = Carbon::createFromFormat('d/m/Y', $item[0]->s_dob)->format('Y/m/d');
                $years = Carbon::parse($new_dob)->diff(Carbon::now());
            @endphp
            <div class="table-responsive ">
                <table class="table table-bordered table-vcenter">
                    <tbody class="text-white fw-semibold">
                        <tr>
                            <td>ID</td>
                            <td>{{$item[0]->student_id}}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{$item[0]->s_name}}</td>
                        </tr>
                        <tr>
                            <td>Guardian's Name</td>
                            <td>{{$item[0]->g_name}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{$item[0]->s_address}}, P.O.: {{$item[0]->s_post_office}}, PIN: {{$item[0]->s_pin_code}}</td>
                        </tr>
                        <tr>
                            <td>Aadhaar No.</td>
                            <td>{{$item[0]->s_adh_no}}</td>
                        </tr>
                        <tr>
                            <td>Date of Birth</td>
                            <td>{{$item[0]->s_dob}}</td>
                        </tr>
                        <tr>
                            <td>Age</td>
                            <td>{{$years->y}} years</td>
                        </tr>
                        <tr>
                            <td>Contact No.</td>
                            <td>{{$item[0]->s_contact}}</td>
                        </tr>
                        <tr>
                            <td>Roll No.</td>
                            <td>{{ $item[0]->s_roll == null ? 'Not Allotted' : $item[0]->s_roll }}</td>
                        </tr>
                        <tr>
                            <td>Class</td>
                            <td>{{$item[0]->c_name}}</td>
                        </tr>
                        <tr>
                            <td>Section</td>
                            <td>{{$item[0]->sec_name}}</td>
                        </tr>
                        <tr>
                            <td>Registration Fees</td>
                            <td>₹ {{$item[0]->s_r_fees}}</td>
                        </tr>
                        <tr>
                            <td>Tuition Fees</td>
                            <td>{{ $item[0]->s_t_fees == null ? 'Not Provided' : '₹ '.$item[0]->s_t_fees }}</td>
                        </tr>
                        <tr>
                            <td>Other Fees</td>
                            <td>{{ $item[0]->s_o_fees == null ? 'Not Provided' : '₹ '.$item[0]->s_o_fees }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
