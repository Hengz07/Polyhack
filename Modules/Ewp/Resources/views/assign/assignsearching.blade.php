<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css"> 
<div class="container-fluid">
    <div class="{{ config('adminlte.card_default') }}"> 
        <div class="card-header"> 
            List of user who have screened 
        </div> 

        <form action="{{ $route??null }}" method="GET"> 

        {{-- <form action="{{ $route??null }}" method="GET"> --}}
            <div class="card-body"> 
                <div class="row mb-3"> 
                    <div class="col-xl-1 text-bold">Name</div> 
                    <div class="col-xl-5"> 
                        <div class="input-group mb-3"> 
                            {!! Form::text('q', $q, array( 
                                'placeholder' => __('Search by name'), 
                                'class' => 'form-control', 
                                'oninput' => 'this.value = this.value.toUpperCase()'
                            )) !!} 

                            <div class="input-group-append"></div> 
                        </div> 
                    </div> 

                    <div class="col-sm-1 text-bold">Session</div> 
                    <div class="col-sm-2"> 
                        <select class="form-control selFilterSession" id="session" name="session" style="width: 100%;">
                            @if(isset($s_session))
                                <option value = "{{ $s_session }}">All Session</option>
                            @endif
                        </select> 
                    </div>

                    <div class="col-sm-1 text-bold">Phase</div> 
                    <div class="col-sm-2"> 
                        <select class="form-control selFilterSemester" id="semester" name="semester" style="width: 100%;">
                            @if(isset($s_session))
                                <option value = "{{ $s_semester }}">{{ $s_semester }}</option>
                            @endif
                        </select> 
                    </div> 
                </div> 
                    
                <div class="row mb-3"> 
                    @if(isset($specific) && $specific)
                    @can(['search'])
                @endif
                <div class="col-sm-1 text-bold">Admin Officer</div>
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
                @if(isset($specific) && $specific)
                    @endcan
                @endif 

                    <div class="col-sm-1 text-bold">Status</div> 
                    <div class="col-sm-5"> 
                        <select class="form-control" id="status" name="status" style="width: 100%;">
                            <option value='' selected>- Select Status -</option>
                            <option value='INTERVENSI KHUSUS' {{ (($s_status == 'INTERVENSI KHUSUS') ? 'selected' : '') }}>Special Intervention</option>
                            <option value='INTERVENSI UMUM' {{ (($s_status == 'INTERVENSI UMUM') ? 'selected' : '') }}>Normal</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="card-footer">

                <button type="submit" class="btn btn-primary float-right" title="">
                    <i class="fa fa-search"></i>  Search   
                </button>

                <a href={{ route('ewp.reports.exportRep') }}>
                    <button type="button" class="btn btn-success float-right" style="margin-right: 20px;" title="Click to download report">
                        <i class="fa fa-file-excel fa-success"></i>
                    </button>
                </a>
                
            </div>
        </form>
    </div>
</div>
