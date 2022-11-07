{!! Form::open(['route' => 'ewp.setup.schedules.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

{{-- @include('setup.question.form') --}}
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-2 text-bold">Session<span style="color: red">*</span></div>
            <div class="col-1 text-bold"> :</div>    
            <div class="col-3">
                    <select class="form-control" name="session">
                        <option value="{{ date('Y')-1 }}/{{ date('Y') }}">{{ date('Y')-1 }} / {{ date('Y') }}</option>
                        <option value="{{ date('Y') }}/{{ date('Y')+1 }}">{{ date('Y') }} / {{ date('Y')+1 }}</option>
                        <option value="{{ date('Y')+1 }}/{{ date('Y')+2 }}">{{ date('Y')+1 }} / {{ date('Y')+2 }}</option>
                    </select>
            </div>

            <div class="col-2 text-bold">Semester<span style="color: red">*</span></div>
            <div class="col-1 text-bold"> :</div>
            <div class="col-3">
                <select class="form-control" name="semester">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-2 text-bold">Start Date<span style="color: red">*</span></div>
            <div class="col-1 text-bold"> :</div>
            <div class="col-3">
                {!! Form::date('start_date', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter start date',
                    'required'    => 'required',
                ]) !!}
            </div>

            <div class="col-2 text-bold">End Date</div>
            <div class="col-1 text-bold"> :</div>
            <div class="col-3">
                {!! Form::date('end_date', null, [
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
                {!! Form::radio('category', 'DEGREE', false) !!}
                <label>
                    DEGREE
                </label>
            </div>

            <div class="col-3"> 
                {!! Form::radio('category', 'UNDERGRADUATE', false) !!}
                <label>
                    UNDERGRADUATE
                </label>
            </div>
            
            <div class="col-3"> 
                {!! Form::radio('category', 'POSTGRADUATE', false) !!}
                <label>
                    POSTGRADUATE
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

