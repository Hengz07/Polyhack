{!! Form::open(['route' => 'ewp.setup.schedules.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

{{-- @include('setup.question.form') --}}
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Session<span style="color: red">*</span></div>
            <div class="col-sm-1 text-bold"> :</div>    
            <div class="col-sm-3">
                    <select class="form-control" name="session">
                        <option value="{{ date('Y')-1 }}/{{ date('Y') }}">{{ date('Y')-1 }} / {{ date('Y') }}</option>
                        <option value="{{ date('Y') }}/{{ date('Y')+1 }}">{{ date('Y') }} / {{ date('Y')+1 }}</option>
                        <option value="{{ date('Y')+1 }}/{{ date('Y')+2 }}">{{ date('Y')+1 }} / {{ date('Y')+2 }}</option>
                    </select>
            </div>

            <div class="col-sm-2 text-bold">Semester<span style="color: red">*</span></div>
            <div class="col-sm-1 text-bold"> :</div>
            <div class="col-sm-3">
                <select class="form-control" name="semester">
                    @for($i = 1;$i <= 5;$i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Start Date<span style="color: red">*</span></div>
            <div class="col-sm-1 text-bold"> :</div>
            <div class="col-sm-3">
                {!! Form::date('start_date', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter start date',
                    'required'    => 'required',
                ]) !!}
            </div>

            <div class="col-sm-2 text-bold">End Date</div>
            <div class="col-sm-1 text-bold"> :</div>
            <div class="col-sm-3">
                {!! Form::date('end_date', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter end date',
                    'required'    => 'required',
                ]) !!}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Category<span style="color: red">*</span></div>
            <div class="col-sm-1 text-bold"> :</div>

            <div class="col-sm-4"> 
                {!! Form::checkbox('category[]', 'PASUM', false) !!}
                <label>
                    PASUM - FOUNDATION
                </label>
            </div>
            <span class="col-sm-1"></span>
            <div class="col-sm-4"> 
                {!! Form::checkbox('category[]', 'UG', false) !!}
                <label>
                    UG - UNDERGRADUATE
                </label>
            </div>
        </div>
        
        <div class="row mb-3">
            <span class="col-sm-2 text-bold"></span>
            <span class="col-sm-1 text-bold"></span>
            <div class="col-sm-4"> 
                {!! Form::checkbox('category[]', 'PG', false) !!}
                <label>
                    PG - POSTGRADUATE
                </label>
            </div>
            <span class="col-sm-1 text-bold"></span>
            <div class="col-sm-4"> 
                {!! Form::checkbox('category[]', 'ST', false) !!}
                <label>
                    ST - STAFF
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

