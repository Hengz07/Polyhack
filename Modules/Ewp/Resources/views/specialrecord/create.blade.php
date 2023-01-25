{!! Form::open(['route' => 'ewp.specialrecord.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

{{-- @include('setup.question.form') --}}
<div class="card">
    <div class="card-body">
        <label class='text-primary'> Isu / Permasalahan </label>

        <div class="row mb-3">
            @foreach($issue as $isu)
                <div class="col-sm-4"> 
                    {!! Form::checkbox($isu['value_local'], $isu['code'], false) !!}
                    <label>
                        {{ $isu['value_local'] }} 
                    </label> 
                </div> 
            @endforeach 
        </div> 

        <label class='text-primary'> Status </label>
        
        <div class="row mb-3">
            @foreach($status as $stat)
                <div class="col-sm-2"> 
                    {!! Form::checkbox($stat['value_local'], $stat['code'], false) !!}
                    <label>
                        {{ $stat['value_local'] }}
                    </label>
                </div>
            @endforeach
        </div>

        <label class='text-primary'> Kategori </label>

        <div class="row mb-3">
            @foreach($refer as $ref)
                <div class="col-sm-2">
                    {!! Form::checkbox($ref['value_local'], $ref['code'], false) !!}
                    <label>
                        {{ $ref['value_local'] }}
                    </label>
                </div>
            @endforeach
        </div>

        <label class='text-primary'> Ulasan </label>

        <div class="row mb-3">
            <div class="col-sm-12"> 
                {!! Form::text('text', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Sila berikan ulasan',
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

