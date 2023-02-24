<div class="container-fluid">
    <div class="{{ config('adminlte.card_default') }}"> 
        <div class="card-header"> 
            Senarai pelajar dan staff yang telah membuat saringan 
        </div> 

        {{-- <form action="{{ $route??null }}" method="GET">  --}}
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

        <form action="{{ $route??null }}" method="GET">
            <div class="card-body"> 
                <div class="row mb-3"> 
                    <div class="col-xl-1 text-bold">Nama</div> 
                    <div class="col-xl-5"> 
                        <div class="input-group mb-3"> 
                            {!! Form::text('q', $q, array( 
                                'placeholder' => __('Carian mengikut nama'), 
                                'class' => 'form-control', 
                                'oninput' => 'this.value = this.value.toUpperCase()'
                            )) !!} 

                            <div class="input-group-append"></div> 
                        </div> 
                    </div> 

                    <div class="col-sm-1 text-bold">Sesi</div> 
                    <div class="col-sm-2"> 
                        <select class="form-control selFilterSession" id="session" name="session" style="width: 100%;">
                            @if(isset($s_session))
                                <option value = "{{ $s_session }}">{{ $s_session }}</option>
                            @endif
                        </select> 
                    </div> 

                    <div class="col-sm-1 text-bold">Semester</div> 
                    <div class="col-sm-2"> 
                        <select class="form-control selFilterSemester" id="semester" name="semester" style="width: 100%;">
                            @if(isset($s_session))
                                <option value = "{{ $s_semester }}">{{ $s_semester }}</option>
                            @endif
                        </select> 
                    </div> 
                </div> 
                    
                <div class="row mb-3"> 
                    <div class="col-sm-1 text-bold">Fakulti</div> 
                    <div class="col-sm-5"> 
                        <select class="form-control selFilterFaculty" id="faculty" name="faculty" style="width: 100%;"></select> 
                    </div> 

                    <div class="col-sm-1 text-bold">Status</div> 
                    <div class="col-sm-5"> 
                        <select class="form-control" id="status" name="status" style="width: 100%;">
                            <option value='' disabled selected>- Pilih Status -</option>
                            <option value='INTERVENSI KHUSUS' {{ (($s_status == 'INTERVENSI KHUSUS') ? 'selected' : '') }}>INTERVENSI KHUSUS</option>
                            <option value='INTERVENSI UMUM' {{ (($s_status == 'INTERVENSI UMUM') ? 'selected' : '') }}>INTERVENSI UMUM</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-1 text-bold">Pegawai</div>
                    <div class="col-sm-5">
                        <select class="form-control selFilterOfficer" id="officer" name="officer" style="width: 100%;">
                            @if(isset($s_officer))
                                <option value = "{{ $s_officer }}" >
                                    @foreach($officers as $pegawai)
                                        @if($s_officer == $pegawai['id'])
                                            {{ $pegawai['name'] }}
                                        @endif
                                    @endforeach    
                                </option>
                            @endif
                        </select>
                    </div>  
                </div> 
            </div>

            <div class="card-footer">
                
                <a href={{ route('ewp.reports.exportRep') }}>
                    <button type="button" class="btn btn-success float-left" title="Click to download report">
                        <i class="fa fa-file-excel fa-success"></i>
                    </button>
                </a>

                <button type="submit" class="btn btn-primary float-right" title="">
                    <i class="fa fa-search"></i>  Search   
                </button>
                
            </div>
        </form>
    </div>
</div>