{!! Form::open(['route' => 'ewp.setup.scales.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

{{-- @include('setup.question.form') --}}
<div class="card">
    <div class="card-body">
        <div class="row  mb-3">
            <div class="col-2 text-bold">Code<span style="color: red">*</span></div>
            <div class="col-10">
                {!! Form::text('code', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter code for scale',
                    'required'    => 'required',
                ]) !!}
            </div>
        </div>

        <div class="row  mb-3">
            <div class="col-2 text-bold">Value (BM)<span style="color: red">*</span></div>
            <div class="col-10">
                {!! Form::text('value_local', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter scale (In Malay Language)',
                    'required'    => 'required',
                ]) !!}
            </div>
        </div>

        <div class="row  mb-3">
            <div class="col-2 text-bold">Value (BI)</div>
            <div class="col-10">
                {!! Form::text('value_translation', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter scale (In English Language)',
                ]) !!}
            </div>
        </div>

        <div class="row  mb-3">
            <div class="col-2 text-bold">Description</div>
            <div class="col-10">
                {!! Form::text('desc', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter the description of the scale',
                ]) !!}
            </div>
        </div>
    </div>
</div>

<hr>
<center>
    <a class="btn btn-default" data-dismiss="modal" aria-label="Close"> Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</center>

{!! Form::close() !!}

