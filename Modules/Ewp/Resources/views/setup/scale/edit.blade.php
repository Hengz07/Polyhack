{!! Form::open(['route' => ['ewp.setup.scales.update', $category->id], 'method' => 'POST']) !!}
@method('PUT')

{{-- @include('setup.question.form') --}}
{{-- @foreach () --}}

<div class="card">
    <div class="card-body">

        <div class="row  mb-3">
            <div class="col-sm-4"></div>
            <div class="col-sm-2 text-bold text-center">MIN<span style="color: red"> *</span></div>
                
            <div class="col-sm-2 text-bold text-center">MAX<span style="color: red"> *</span></div>
            <div class="col-sm-4"></div>
        </div>

        @foreach ($meta as $key => $cat)
            <div class="row  mb-3">
                <div class="col-sm-2"></div>
                    <div class="col-sm-2 text-bold">{{ $cat['name'] }}</div>
                        <input type="hidden" class="form-control" placeholder="{{ $cat['name'] }}" name="value[{{ $key }}][name]" value="{{ $cat['name'] }}" >
                    <div class="col-sm-2">
                        {{-- <input type='number' class="form-control" placeholder="{{ $cat['min'] }}" name="value[{{ $key }}][min]" value="{{ $cat['min'] }}" > --}}
                        
                        {!! Form::number('value[' .$key. '][min]', $cat['min'], [
                            'class'       => 'form-control',
                            'placeholder' => $cat['min'],
                            'required'    => 'required',
                            // 'value'       => $cat['min'],
                        ]) !!}
                    </div>

                    <div class="col-sm-2">
                        {{-- <input type='number' class="form-control" placeholder="{{ $cat['max'] }}" name="value[{{ $key }}][max]" value="{{ $cat['max'] }}" > --}}
                        {!! Form::number('value[' .$key. '][max]', $cat['max'], [
                            'class'       => 'form-control', 
                            'placeholder' => $cat['max'],
                            'required'    => 'required',
                            // 'value'       => $cat['max'],
                        ]) !!}
                    </div>
                <div class="col-sm-4"></div>
            </div>
        @endforeach
    </div>
</div>

<hr>
<center>
    <a class="btn btn-default" data-dismiss="modal" aria-label="Close"> Cancel</a>
    <button type="submit" class="btn btn-primary">Submit</button>
</center>

{!! Form::close() !!}

