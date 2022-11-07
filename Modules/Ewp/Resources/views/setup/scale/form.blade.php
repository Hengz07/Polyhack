<div class="row  mb-3">
    <div class="col-2 text-bold">Test<span style="color: red">*</span></div>
    <div class="col-10"> 
        <select class="form-control selInstituteText" id="namecode" name="namecode" style="width: 100%;" required></select>
    </div>
</div>

<div class="row  mb-3">
    <div class="col-2 text-bold">Code<span style="color: red">*</span></div>
    <div class="col-10">
        {!! Form::textarea('code', null, [
            'class'       => 'form-control',
            'placeholder' => 'Enter scales/questions',
            'required'    => 'required',
        ]) !!}
    </div>
</div>

<div class="row  mb-3">
    <div class="col-2 text-bold">Value (BM)<span style="color: red">*</span></div>
    <div class="col-10">
        {!! Form::email('value_local', null, [
            'class'       => 'form-control',
            'placeholder' => 'Enter value of scales/questions',
            'required'    => 'required',
        ]) !!}
    </div>
</div>

<div class="row  mb-3">
    <div class="col-2 text-bold">Value (BI)<span style="color: red">*</span></div>
    <div class="col-10">
        {!! Form::email('value_translation', null, [
            'class'       => 'form-control',
            'placeholder' => 'Enter value translation of scales/questions',
            'required'    => 'required',
        ]) !!}
    </div>
</div>

<div class="row  mb-3">
    <div class="col-2 text-bold">Description<span style="color: red">*</span></div>
    <div class="col-10">
        {!! Form::textarea('desc', null, [
            'class'       => 'form-control',
            'placeholder' => 'Enter the description of the value',
            'required'    => 'required',
        ]) !!}
    </div>
</div>
