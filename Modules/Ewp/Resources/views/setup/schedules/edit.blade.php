{!! Form::open(['route' => ['ewp.setup.schedules.update', $schedules->id], 'method' => 'POST']) !!}
@method('PUT')

{{-- @include('setup.question.form') --}}
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Session<span style="color: red">*</span></div>
            <div class="col-sm-1 text-bold"> :</div>    
            <div class="col-sm-3">
                <select class="form-control" name="session">
                    <option value="{{ date('Y') }}" {{ (($schedules['session'] == ((date('Y')))) ? 'selected' : '') }}>{{ date('Y') }}</option>
                    <option value="{{ date('Y')+1 }}" {{ (($schedules['session'] == ((date('Y')+1))) ? 'selected' : '') }}>{{ date('Y')+1 }}</option>
                    <option value="{{ date('Y')+2 }}" {{ (($schedules['session'] == ((date('Y')+2))) ? 'selected' : '') }}>{{ date('Y')+2 }}</option>
                </select>
            </div>

            <div class="col-sm-2 text-bold">Phase<span style="color: red">*</span></div>
            <div class="col-sm-1 text-bold"> :</div>
            <div class="col-sm-3">
                <select class="form-control" name="semester">
                    @for($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ (($schedules['semester'] == $i) ? 'selected' : '') }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Start Date<span style="color: red">*</span></div>
            <div class="col-sm-1 text-bold"> :</div>
            <div class="col-sm-3">
                {!! Form::date('start_date', $schedules['start_date'], [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter start date',
                    'required'    => 'required',
                ]) !!}
            </div>

            <div class="col-sm-2 text-bold">End Date</div>
            <div class="col-sm-1 text-bold"> :</div>
            <div class="col-sm-3">
                {!! Form::date('end_date', $schedules['end_date'], [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter end date',
                    'required'    => 'required',
                ]) !!}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Category<span style="color: red">*</span></div>
            <div class="col-sm-1 text-bold"> :</div>

            <div class="col-sm-4 icheck-primary icheck-inline"> 
                {!! Form::checkbox('category[]', 'PG', true,
                    array(
                        'id' => 'PG',
                    )
                ) !!}
                <label for="PG">
                    USR - User
                </label>
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