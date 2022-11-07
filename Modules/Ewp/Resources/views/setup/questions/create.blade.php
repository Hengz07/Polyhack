{!! Form::open(['route' => 'ewp.setup.questions.store', 'method' => 'POST', 'class' => 'form-horizontal']) !!}

{{-- @include('setup.question.form') --}}
<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-1 text-bold">Category<span style="color: red">*</span></div>
            <div class="col-1 text-bold"> :</div>
            <div class="col-10"> 
                <select class="form-control selCategory" id="namecode" name="category" style="width: 100%;" required></select>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-1 text-bold">Code<span style="color: red">*</span></div>
            <div class="col-1 text-bold"> :</div>
            <div class="col-4">
                {!! Form::text('code', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter code for question',
                    'required'    => 'required',
                ]) !!}
            </div>

            <div class="col-1 text-bold">Order<span style="color: red">*</span></div>
            <div class="col-1 text-bold"> :</div>
            <div class="col-4"> 
                {!! Form::text('order', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter question order',
                    'required'    => 'required',
                ]) !!}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-1 text-bold">Question (BM)<span style="color: red">*</span></div>
            <div class="col-1 text-bold"> :</div>
            <div class="col-10">
                {!! Form::text('value_local', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter question (In Malay Language)',
                    'required'    => 'required',
                ]) !!}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-1 text-bold">Question (BI)</div>
            <div class="col-1 text-bold"> :</div>
            <div class="col-10">
                {!! Form::text('value_translation', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter question (In English Language)',
                ]) !!}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-2 text-bold">Description :</div>
            <div class="col-10">
                {!! Form::text('desc', null, [
                    'class'       => 'form-control',
                    'placeholder' => 'Enter the description of the question',
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

