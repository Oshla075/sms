<div class="bg-image" style="background-image: url('{{ url('/') }}/assets/media/photos/photo12@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full text-center text-white">
            <h1 class="fs-xl"><u>Guardian {{$query[0]->g_name}}'s Profile</u></h1>
            <div class="my-2 mb-3">
                @if ($query[0]->g_photo == null)
                    <img class="img-avatar img-avatar-thumb" src="{{ url('/') }}/assets/media/avatars/avatar13.jpg"
                    alt="">
                @else
                <img class="img-avatar img-avatar-thumb" src="{{url('/storage')}}/parents/{{$query[0]->g_id}}/{{$query[0]->g_photo}}" style="width: 200px !important; height: 200px !important;"  alt="">
                @endif
            </div>
            <div class="table-responsive ">
                <table class="table table-bordered table-vcenter">
                    <tbody class="text-white fw-semibold">
                        <tr>
                            <td>ID</td>
                            <td>{{$query[0]->g_id}}</td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{$query[0]->g_name}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>{{$query[0]->g_address}}, P.O.: {{$query[0]->g_post_office}}, PIN: {{$query[0]->g_pin_code}}</td>
                        </tr>
                        <tr>
                            <td>Aadhaar No.</td>
                            <td>{{$query[0]->adh_no}}</td>
                        </tr>
                        <tr>
                            <td>Contact No.</td>
                            <td>{{$query[0]->g_contact_1}}</td>
                        </tr>
                        <tr>
                            <td>Alternate Contact No.</td>
                            <td>{{ $query[0]->g_contact_2 == null ? 'Not Provided' : $query[0]->g_contact_2 }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card mb-4 mt-4 p-2">
    {{-- <div class="card-header">
    </div> --}}
    <div class="card-body">
        <div class="row">
            <form action="">
                <div class="mb-3">
                    <label class="form-label" for="ac_year">Year</label>
                    <select required class="js-select2 form-select" id="ac_year" name="ac_year" style="width: 100%;"
                        data-placeholder="Choose one.." onchange="getstudetails(event);">
                        <option></option>
                        @for ($i = $estd; $i <= date('Y'); $i++)
                        <option value="{{$i}}">{{$i}}</option>
                        @endfor
                            <!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    </select>
                </div>
            </form>
            <div class="mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr class="bg-secondary text-white">
                                <th style="width: 40%;" class="text-center">Student Details</th>
                                <th style="width: 60%;" class="text-center">Qualification</th>
                                {{-- <th style="width: 25%;" class="text-center">Transaction</th> --}}
                            </tr>
                            <tbody id="tble">
                            </tbody>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



