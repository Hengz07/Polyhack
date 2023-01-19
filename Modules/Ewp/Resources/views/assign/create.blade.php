{!! Form::open(['route' => ['ewp.assign.store'], 'method' => 'POST', 'class' => 'form-horizontal']) !!}

{{-- @include('setup.question.form') --}}
<div class="card" id="saveall">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-xl-1 text-bold">Officer</div>
            <div class="col-xl-1 text-bold"> :</div>
            <div class="col-xl-10">
                <select class="form-control selModalOfficer" id="namecode" name="officer" style="width: 100%;" required></select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-xl-1 text-bold">Test</div>
            <div class="col-xl-1 text-bold"> :</div>
            <div class="col-xl-10">
                <input id="sid" name="sid">
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

