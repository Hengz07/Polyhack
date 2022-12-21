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
                    @if(str_contains($schedules['category'], 'ST'))
                        <option value="{{ date('Y') }}" {{ (($schedules['session'] == ((date('Y')))) ? 'selected' : '') }}>{{ date('Y') }}</option>
                        <option value="{{ date('Y')+1 }}" {{ (($schedules['session'] == ((date('Y')+1))) ? 'selected' : '') }}>{{ date('Y')+1 }}</option>
                        <option value="{{ date('Y')+2 }}" {{ (($schedules['session'] == ((date('Y')+2))) ? 'selected' : '') }}>{{ date('Y')+2 }}</option>
                    @else
                        <option value="{{ date('Y')-1 }}/{{ date('Y') }}" {{ (($schedules['session'] == ((date('Y')-1).'/'.(date('Y')))) ? 'selected' : '') }}>{{ date('Y')-1 }}/{{ date('Y') }}</option>
                        <option value="{{ date('Y') }}/{{ date('Y')+1 }}" {{ (($schedules['session'] == ((date('Y')).'/'.(date('Y')+1))) ? 'selected' : '') }}>{{ date('Y') }}/{{ date('Y')+1 }}</option>
                        <option value="{{ date('Y')+1 }}/{{ date('Y')+2 }}" {{ (($schedules['session'] == ((date('Y')+1).'/'.(date('Y')+2))) ? 'selected' : '') }}>{{ date('Y')+1 }}/{{ date('Y')+2 }}</option>
                    @endif
                </select>
            </div>

            <div class="col-sm-2 text-bold">Semester<span style="color: red">*</span></div>
            <div class="col-sm-1 text-bold"> :</div>
            <div class="col-sm-3">
                <select class="form-control" name="semester">
                    @for($i = 1;$i <= 5;$i++)
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
            
            <div class="col-sm-4"> 
                <input type="checkbox" name="category[]" value="PASUM" {{ str_contains($schedules['category'], 'PASUM') ? 'checked' : '' }}></input>
                <label> PASUM - FOUNDATION </label>
            </div>

            <span class="col-sm-1 text-bold"></span>
            <div class="col-sm-4"> 
                <input type="checkbox" name="category[]" value="UG" {{ str_contains($schedules['category'], 'UG') ? 'checked' : '' }}></input>
                <label> UG - UNDERGRADUATE </label>
            </div>
        </div>
        
        <div class="row mb-3">
            <span class="col-sm-2 text-bold"></span>
            <span class="col-sm-1 text-bold"></span>
            
            <div class="col-sm-4"> 
                <input type="checkbox" name="category[]" value="PG" {{ str_contains($schedules['category'], 'PG') ? 'checked' : '' }}></input>
                <label> PG - POSTGRADUATE </label>
            </div>
            <span class="col-sm-1 text-bold"></span>
            <div class="col-sm-4"> 
                <input type="checkbox" name="category[]" value="ST" {{ str_contains($schedules['category'], 'ST') ? 'checked' : '' }}></input>
                <label> ST - STAFF </label>
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

