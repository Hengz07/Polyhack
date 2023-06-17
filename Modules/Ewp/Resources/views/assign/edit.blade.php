{!! Form::open(['route' => ['ewp.assign.update', $id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
@method('PUT')

{{-- @include('setup.question.form') --}}
<div class="card">
    <div class="card-body">
        <label class='text-primary'> Isu / Permasalahan </label> 
        
        <div class="row mb-3"> 
            @foreach($issue as $isu) 
                <div class="col-sm-4 icheck-primary icheck-inline"> 
                    @if(!isset($assign['status']) && !isset($assignmeta))
                        {!! Form::checkbox('issue[]', $isu['value_local'], false,
                                array(
                                    'id' => $isu['value_local'],
                                )
                        )!!} 
                    @else
                        <input type="checkbox" name="issue[]" value="{{ $isu['value_local'] }}" id="{{ $isu['value_local'] }}" {{ str_contains($assignmeta['issue'], $isu['value_local']) ? 'checked' : '' }} />
                    @endif

                    <label for="{{ $isu['value_local'] }}"> 
                        {{ $isu['value_local'] }} 
                    </label> 
                </div> 
            @endforeach 
        </div> 
        
        <label class='text-primary'> Status </label>
        
        <div class="row mb-3"> 
            @foreach($status as $stat) 
                <div class="col-sm-2 icheck-primary icheck-inline"> 
                    @if(!isset($assign['status']) && !isset($assignmeta))
                        {!! Form::radio('status', $stat['value_local'], false, 
                                array(
                                    'id' => $stat['value_local'],
                                    'onclick' => 'myFunction()',
                                )
                        )!!}
                    @else
                        <input type="radio" name="status" value="{{ $stat['value_local'] }}" id="{{ $stat['value_local'] }}" onclick="myFunction()" {{ str_contains($assign['status'], substr($stat['value_local'], 0, 1)) ? 'checked' : '' }} />
                    @endif
                
                    <label for="{{ $stat['value_local'] }}">
                        {{ $stat['value_local'] }}
                    </label>
                </div> 
            @endforeach 
        </div> 

        <div id="statcat" style="display: none;">
            <label class='text-primary'> Kategori </label> 

            <div class="row mb-3"> 
                @foreach($refer as $ref) 
                    <div class="col-sm-2 icheck-primary icheck-inline"> 
                        @if(!isset($assign['status']) && !isset($assignmeta))
                            {!! Form::checkbox('refer[]', $ref['value_local'], false, 
                                array(
                                    'id' => $ref['value_local'],
                                    'onclick' => 'myFunction()',
                                )
                            )!!} 
                        @else
                            <input type="checkbox" name="refer[]" value="{{ $ref['value_local'] }}" id="{{ $ref['value_local'] }}" onclick="myFunction()" {{ str_contains($assignmeta['refer'], $ref['value_local']) ? 'checked' : '' }} />
                        @endif

                        <label for="{{ $ref['value_local'] }}"> 
                            {{ $ref['value_local'] }} 
                        </label> 
                    </div> 
                @endforeach 
            </div> 
        </div>

        <label class='text-primary'> Ulasan </label>

        @php

            if(!isset($assignmeta['comment'])){
                $comment = null;
            }
            else {
                $comment = $assignmeta['comment'];
            }

        @endphp
            
        <div class="row mb-3">
            <div class="col-sm-12"> 
                {!! Form::textarea('comment', $comment, [
                    'class'       => 'form-control',
                    'placeholder' => 'Sila berikan ulasan',
                    'required'    => 'required',
                ]) !!}
            </div>
        </div>

        <div>
            {{ Form::hidden('report_id', $id) }}
        </div>
    </div>
</div>

<hr>
<center>
    <a class="btn btn-default float-right" data-dismiss="modal" aria-label="Close">Cancel</a>
    <button type="submit" class="btn btn-primary float-right">Submit</button>
</center>


{!! Form::close() !!}