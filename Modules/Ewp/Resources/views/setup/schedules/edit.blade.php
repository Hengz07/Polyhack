{!! Form::open(['route' => ['ewp.setup.schedules.update', $schedules->id], 'method' => 'POST']) !!}
@method('PUT')

{{-- @include('setup.question.form') --}}
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-2 text-bold">Session<span style="color: red">*</span></div>
            <div class="col-1 text-bold"> :</div>    
            <div class="col-3">
                    <select class="form-control" name="session">
                        @foreach($schedules as $sch)
                            <option value="{{ $schedules['session'] }}" @selected(old('session') == $schedules['session'])>{{ $schedules['session'] }}</option>
                        @endforeach
                    </select>
            </div>

            <div class="col-2 text-bold">Semester<span style="color: red">*</span></div>
            <div class="col-1 text-bold"> :</div>
            <div class="col-3">
                <select class="form-control" name="semester">
                    @foreach($schedules as $sch)
                        <option value="{{ $schedules['semester'] }}" @selected(old('semester') == $schedules['semester'])>{{ $schedules['semester'] }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-2 text-bold">Start Date<span style="color: red">*</span></div>
            <div class="col-1 text-bold"> :</div>
            <div class="col-3">
                {!! Form::date('start_date', $schedules['start_date'], [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter start date',
                    'required'    => 'required',
                ]) !!}
            </div>

            <div class="col-2 text-bold">End Date</div>
            <div class="col-1 text-bold"> :</div>
            <div class="col-3">
                {!! Form::date('end_date', $schedules['end_date'], [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter end date',
                    'required'    => 'required',
                ]) !!}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-2 text-bold">Category<span style="color: red">*</span></div>

            <div class="col-1 text-bold"> :</div>
            <div class="col-3"> 
                <input type="radio" name="category" value="DEGREE" {{ $schedules['category'] == 'DEGREE' ? 'checked' : '' }}></input>
                <label> DEGREE </label>
            </div>

            <div class="col-3"> 
                <input type="radio" name="category" value="UNDERGRADUATE" {{ $schedules['category'] == 'UNDERGRADUATE' ? 'checked' : '' }}></input>
                <label> UNDERGRADUATE </label>
            </div>
            
            <div class="col-3"> 
                <input type="radio" name="category" value="POSTGRADUATE" {{ $schedules['category'] == 'POSTGRADUATE' ? 'checked' : '' }}></input>
                <label> POSTGRADUATE </label>
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

