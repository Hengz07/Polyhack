{!! Form::open(['route' => 'ewp.dashboards.reports.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

{{-- @include('setup.question.form') --}}
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Session :</div>
            <div class="col-sm-4">
                @foreach($schedules as $sch) @endforeach

                <p class="text-bold text-secondary"> {{ $sch['session'] }} </p>
            </div>

            <div class="col-sm-1 text-bold"></div>
        
            <div class="col-sm-2 text-bold">Semester :</div>
            <div class="col-sm-2">
                <p class="text-bold text-secondary"> {{ $sch['semester'] }} </p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Name :</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $users['name'] }} </p>
            </div>
    
            <div class="col-sm-1 text-bold"></div>

            <div class="col-sm-2 text-bold">Gender :</div>
            <div class="col-sm-2">
                <p class="text-bold text-secondary"> {{ $meta['gender'] }} </p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Email :</div>
            {{-- <div class="col-sm-1 text-bold"> :</div>     --}}
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $users['email'] }} </p>
            </div>

            <div class="col-sm-1 text-bold"></div>
            
            <div class="col-sm-2 text-bold">Matric Number :</div>
            <div class="col-sm-2">
                @foreach($profiles as $profile) @endforeach

                <p class="text-bold text-secondary"> {{ $profile['profile_no'] }} </p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Faculty :</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $jsonb_ptj['code'] }} - {{ $jsonb_ptj['desc'] }} </p>
            </div>
   
            <div class="col-sm-1 text-bold"></div>
            
            <div class="col-sm-2 text-bold">Course :</div>
            <div class="col-sm-3">
                <p class="text-bold text-secondary"> {{ $jsonb_department['code'] }} - {{ $jsonb_department['desc'] }} </p>
            </div>
        </div>

        <hr>

        {{-- <input type="text" value="{{ $sch['id'] }}" name="idschedule"> --}}
        
        <label class="text-primary"><i> Enter your alternate informations for contact reasons </i></label>
        <br><br>
        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Email<span style="color: red">*</span></div>
            <div class="col-sm-4">
                {!! Form::text('alt_email', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter email',
                    'required'    => 'required',
                ]) !!}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Phone<span style="color: red">*</span></div>
            <div class="col-sm-4"> 
                {!! Form::text('alt_phone', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter phone contact',
                    'required'    => 'required',
                ]) !!}
            </div>
        </div>
    </div>
</div>

<hr>
<center>
    <a class="btn btn-default" data-dismiss="modal" aria-label="Close">Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</center>

{!! Form::close() !!}

