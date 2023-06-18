{!! Form::open(['route' => 'ewp.dashboards.reports.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

{{-- @include('setup.question.form') --}}
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-2 text-bold">{{__('Session')}} :</div>
            <div class="col-sm-4">

                <p class="text-bold text-secondary"> {{ $schedules['session'] }} </p>
            </div>

            <div class="col-sm-1 text-bold"></div>
        
            <div class="col-sm-2 text-bold">Phase :</div>
            <div class="col-sm-2">
                <p class="text-bold text-secondary"> {{ $schedules['semester'] }} </p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">{{__('Name')}} :</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $users['name'] }} </p>
            </div>
    
            <div class="col-sm-1 text-bold"></div>

            <div class="col-sm-2 text-bold">{{__('Email')}} :</div>
            <div class="col-sm-2">
                <p class="text-bold text-secondary"> {{ $users['email'] }} </p>
            </div>
        </div>

        <hr>

        {{-- <input type="text" value="{{ $schedules['id'] }}" name="idschedule"> --}}
        
        <label class="text-primary"><i> {{__('Enter your alternate information for contact reason')}} </i></label>
        <br><br>
        <div class="row mb-3">
            <div class="col-sm-2 text-bold">{{__('Email')}}<span style="color: red">*</span></div>
            <div class="col-sm-4">
                {!! Form::email('alt_email', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter email',
                    'required'    => 'required',
                ]) !!}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-2 text-bold">{{__('Phone')}}<span style="color: red">*</span></div>
            <div class="col-sm-4"> 
                {!! Form::tel('alt_phone', null, [
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
    <a class="btn btn-default" data-dismiss="modal" aria-label="Close">{{__('Cancel')}}</a>
    <button type="submit" class="btn btn-primary">{{__('Submit')}}</button>
</center>

{!! Form::close() !!}