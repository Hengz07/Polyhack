@extends('adminlte::page')

<div class="{{ config('adminlte.card_default') }}"> 
    <div class="card-header"> 
        Senarai pelajar dan staff yang telah membuat saringan 
    </div> 
    <div class="card-header"> 
        <div class="row mb-3"> 
            <div class="col-xl-5 text-bold"> 
                <div class="icheck-primary icheck-inline"> 
                    <input type="radio" name="usertype" value="alluser" id="alluser" checked /><label for="alluser">All</label> 
                </div> 
                <div class="icheck-primary icheck-inline"> 
                    <input type="radio" name="usertype" value="student" id="student" /><label for="student">Student</label> 
                </div> 
                <div class="icheck-primary icheck-inline"> 
                    <input type="radio" name="usertype" value="staff" id="staff" /><label for="staff">Staff</label> 
                </div> 
            </div> 
        </div> 
    </div> 

    <form action="{{ $route??null }}" method="get"> 
        <div class="card-body"> 
            <div class="row mb-3"> 
                <div class="col-xl-1 text-bold">Nama</div> 
                <div class="col-xl-5"> 
                    <div class="input-group mb-3"> 
                        {!! Form::text('q', $q, array( 
                            'placeholder' => __('Carian mengikut nama'), 
                            'class' => 'form-control', 
                        )) !!} 

                        <div class="input-group-append"></div> 
                    </div> 
                </div> 

                <div class="col-sm-1 text-bold">Sesi</div> 
                <div class="col-sm-2"> 
                    <select class="form-control" id="selFilterSession" name="session" style="width: 100%;" required></select> 
                </div> 

                <div class="col-sm-1 text-bold">Semester</div> 
                <div class="col-sm-2"> 
                    <select class="form-control" id="selFilterSemester" name="semester" style="width: 100%;" required></select> 
                </div> 
            </div> 
                
            <div class="row mb-3"> 
                <div class="col-sm-1 text-bold">Fakulti</div> 
                <div class="col-sm-5"> 
                    <select class="form-control" id="selFilterFaculty" name="faculty" style="width: 100%;" required></select> 
                </div> 

                <div class="col-sm-1 text-bold">Status</div> 
                <div class="col-sm-5"> 
                    <select class="form-control" id="selFilterStatus" name="status" style="width: 100%;" required></select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-1 text-bold">Pegawai</div>
                <div class="col-sm-5">
                    <select class="form-control" id="selFilterOfficer" name="officer" style="width: 100%;" required></select>
                </div>  
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary" title="">
                Papar
            </button>

            <button type="button" class="btn btn-danger">
                Reset
            </button>
             
            <a href='exportreport'>
                <button type="button" class="btn btn-success float-right" title="Click to download report">
                    <i class="fa fa-file-excel fa-success"></i>
                </button>
            </a>
        </div>
    </form>
</div>

@section('js') 
    <script src="{{ asset('js/assign_searching.js') }}"></script>
@endsection