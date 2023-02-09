{!! Form::open(['route' => ['ewp.assign.saringaninfo', $report->id], 'method' => 'POST', 'class' => 'form-horizontal']) !!}
@method('PUT')

{{-- @include('setup.question.form') --}}

<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Name</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $user['name'] }}</p>
            </div>

            <div class="col-sm-2 text-bold">Student ID</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $profile['profile_no'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Gender</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $meta['gender'] }}</p>
            </div>

            <div class="col-sm-2 text-bold">Race</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $meta['race'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">IC Number</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> -</p>
            </div>
            
            <div class="col-sm-2 text-bold">Phone Number</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $meta['hp_no'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Income</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> -</p>
            </div>

            <div class="col-sm-2 text-bold">Email</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $user['email'] }}</p>
            </div>
        </div>
        
        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Address</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> -</p>
            </div>
        </div>

        <br>
        <label class="text-info"><h5><b>Studies</b></h5></label>
        <br><br>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Faculty</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $ptj['code'] }} - {{ $ptj['desc'] }} </p>
            </div>

            <div class="col-sm-2 text-bold">Program</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $department['desc'] }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm-2 text-bold">Level</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> -</p>
            </div>
   
            <div class="col-sm-2 text-bold">Type</div>
            <div class="col-sm-4">
                <p class="text-bold text-secondary"> {{ $department['desc'] }}</p>
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

