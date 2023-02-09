@extends('adminlte::page')

@section('title', $title ?? "")

@section('content_header')
<div class="d-flex">    
    <div class="mr-auto p-2"><h1>Rekod Saringan</h1></div>
    <div class="p-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.admin_dash') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ "Rekod Saringan" }}</li>
            </ol>
        </nav>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="{{ config('adminlte.card_default') }}">
        <div class="card-header">
            Senarai pelajar yang telah membuat saringan
        </div> 

        <form action="{{ $route??null }}" method="get">
            <div class="card-body"> 
                <div class="row mb-3">
                    <div class="col-xl-1 text-bold"></div>
                    <div class="col-xl-5">
                        {{-- <a> --}}   
                            <button type="submit" class="btn btn-info">
                                Student
                            </button>
                        {{-- </a> --}}
                         {{-- <a> --}}
                            <button type="button" class="btn btn-warning">
                                Staff
                            </button>
                        {{-- </a> --}}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-xl-1 text-bold">Pegguna</div>
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
                        <select class="form-control selFaculty" id="selFilterFaculty" name="faculty" style="width: 100%;" required></select>
                    </div>

                    <div class="col-sm-1 text-bold">Status</div>
                    <div class="col-sm-5">
                        <select class="form-control selStatus" id="selFilterStatus" name="status" style="width: 100%;" required></select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-sm-1 text-bold">Pegawai</div>
                    <div class="col-sm-5">
                        <select class="form-control selOfficer" id="selFilterOfficer" name="officer" style="width: 100%;" required></select>
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
                    
                <button type="button" class="btn btn-success float-right" title="Click to download report">
                    <i class="fa fa-file-excel fa-success"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="{{ config('adminlte.card_default') }}">
        <div class="card-body"> 
            {{-- TRANSLATION --}}
            {{-- @php

                if(app()->currentLocale() == 'ms-my')
                {
                    $    = '';
                }
                
                elseif(app()->currentLocale() == 'en')
                {
                    $    = '';
                }
            
            @endphp --}}
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-navy bg-navy text-center">
                        <tr>
                            @if(app()->currentLocale() == 'ms-my')
                                <th style="min-width:200px"> REKOD SARINGAN </th>
                            @elseif(app()->currentLocale() == 'en')
                                <th style="min-width:200px"> SCREENING RECORD </th>
                            @endif
                        </tr>
                    </thead>
                </table>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-navy bg-navy">
                        <tr class="text-center">
                            <th style="width: 3%"> # </th>
                            <th style="width: 7%"> Session </th>
                            <th style="width: 7%"> ID </th>
                            <th style="width: 7%"> Name </th>
                            <th style="width: 7%"> Faculty </th>
                            <th class="text-center" style="width: 7%"> {{ $D = 'D' }} </th>
                            <th class="text-center" style="width: 7%"> {{ $A = 'A' }} </th>
                            <th class="text-center" style="width: 7%"> {{ $S = 'S' }} </th>
                            <th style="width: 7%"> Status </th>
                            <th style="width: 7%"> Date </th>
                            <th style="width: 8%"> Officer </th>
                            <th style="width: 7%"> 
                                <div class="d-inline-flex input-group">
                                    <div class="icheck-primary icheck-inline">
                                        <input type="checkbox" id="checkboxCheckAll" class="chk-box" />
                                        <label for="checkboxCheckAll"></label>
                                    </div>
                                    
                                    {{-- <div class="input-group-append"> --}}
                                        <a class="{{ config("adminlte.btn_default") }} btn-sm bg-warning" id="saveall"
                                            data-route="ewp/assign/create" data-title="Officer" 
                                            data-toggle="modal"><i class="fas fa-share" style="height: 12px; width: 21px;"></i></a> 
                                    {{-- </div> --}}
                                </div>
                            </th>
                            <th style="width: 10%"> Action </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @if (count($reports) == 0)
                            <td style="text-align: center" colspan="8">No data availables</td>
                        @else
                            @foreach ($reports as $report => $rep)
                                
                                @php
                                    $profile = $rep['profile'];
                                    $user    = $profile['user'];
                                    $assign  = $rep['assign'];

                                    $scale = $rep['scale'];
                                @endphp

                                <tr>
                                    <td class="text-center"> {{ ++$i }} </td>
                                    <td class="text-center"> {{ $rep['session'] }} - {{ $rep['sem'] }} </td> 
                                    <td class="text-center"> {{ $profile['profile_no'] }} </td> 
                                    <td class="text-center"> {{ $user['name'] }} </td> 
                                    <td class="text-center"> {{ $profile['ptj'][0]['desc'] }} </td> 
                                    
                                    @if(isset($scale))
                                        @foreach($minmax as $mm)

                                            @php
                                                $range = json_decode($mm['meta_value'], true);
                                            @endphp

                                            @foreach($scale as $up => $test)
                                                @if($mm['code'] == $up)
                                                    <td class="text-center">
                                                        @foreach($range as $scalestat)
                                                            @if($scale[$up]['value'] >= $scalestat['min'] && $scale[$up]['value'] <= $scalestat['max']) 
                                                                @if($scalestat['name'] == 'TERUK' || $scalestat['name'] == 'SANGAT TERUK')
                                                                    <label class="badge badge-danger px-4">{{ $scale[$up]['value'] }}</label>
                                                                @else
                                                                    <label class="badge badge-success px-4">{{ $scale[$up]['value'] }}</label>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td> 
                                                @endif
                                            @endforeach
                                        @endforeach
                                    @else  
                                        <td class="text-center">
                                            No data available
                                        </td>
                                    @endif

                                    <td class="text-center"> 
                                        @php
                                            if ($scale['A']['status']['intervention'] == 'INTERVENSI KHUSUS' || 
                                                $scale['D']['status']['intervention'] == 'INTERVENSI KHUSUS' || 
                                                $scale['S']['status']['intervention'] == 'INTERVENSI KHUSUS')
                                            {
                                                $intervention = 'INTERVENSI KHUSUS';
                                            }
                                            
                                            else
                                            {
                                                $intervention = 'INTERVENSI UMUM';
                                            }  
                                        @endphp
                                        {{ $intervention }}

                                    </td>
                                    <td class="text-center"> {{ date('d/m/Y', strtotime($rep['created_at'])) }} </td>
                                    <td class="text-center">
                                        
                                        @foreach($officers as $officer)
                                            @if(isset($assign))
                                                @if($assign['officer_id'] == $officer['id'])
                                                    {{ $officer['name'] }}
                                                @endif
                                            @else
                                                {{ '-' }}
                                            @endif
                                        @endforeach

                                    </td>
                                    <td class="text-center">

                                        @if ($intervention == 'INTERVENSI KHUSUS')
                                            <div class="icheck-primary icheck-inline">
                                                <input type="checkbox" class="chk_box_sub" id="{{ $rep['id'] }}" value="{{ $rep['id'] }}" />
                                                <label for="{{ $rep['id'] }}"></label>
                                            </div>
                                        @else
                                            --
                                        @endif

                                    </td>
                                    <td class="text-center"> 
                                        <a class="{{ config("adminlte.btn_edit") }} btn showSaringanInfo bg-info" 
                                            data-route="ewp/assign" data-id="{{ $rep->id }}" data-title="Information" 
                                            data-toggle="modal"><i class="fa fa-id-badge" style="width: 12px;"></i></a>
                                        
                                        {{-- <a class="{{ config("adminlte.btn_default") }} btn-sm showSaringanInfo bg-info" id="showinfo"
                                            data-route="ewp/assign" data-id="{{ $rep['id'] }}" data-title="Saringan Info" 
                                            data-toggle="modal"><i class="fas fa-id-badge" style="width: 12px;"></i></a>  --}}

                                        <button type="button" class="btn btn-sm {{ config('adminlte.btn_default') }} bg-danger">
                                            <i class="fa fa-file"  title="Click to delete questions"></i></button> 

                                    </td> 
                                </tr>   
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- {!! $questions->setPath('')->render() !!} --}}

@include('layouts.delete')
@include('layouts.modal')

@endsection

@section('js') 
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/select_modal.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
    <script type="text/javascript">
        
        $(document).ready(function() {
            $(function() {
                $('.chk-box').click(function() {
                    $('.chk_box_sub').prop('checked',this.checked);
                });
            });
            
            $(function() {
                $('#saveall').click(function() {
                    var checks = $("input[class='chk_box_sub']:checked"); 
                    console.log(checks.val());

                    if(checks.length > 0){
                        var selectId = [];
                        for(var i=0; i<checks.length; i++){
                            selectId.push($(checks[i]).val());
                            // console.log (selectId);
                        }
                        
                        $.get("/ewp/assign/create",
                        {
                            inputname: $(this).data('selectId'),
                            routename: $(this).data('route-name'),
                        },
                        function (data, status) {  
                            // $('#sid').val('i');
                            $('#showOfficer').find('#modal-title')[0].innerHTML = 'Select Officer';
                            $('#showOfficer').find('#modal-body')[0].innerHTML = data;
                            $('#showOfficer').modal();
                            document.getElementById("sid").value = selectId;
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Please select student!',
                        })
                    }
                })
            })
        });

    </script>
@endsection

{{-- KERJA --}}
{{-- SIMPAN ASSIGN, KELUARKAN INFORMATION, CHECKBOX (BUNDLE DAN SINGLE, PAPARKAN UNTUK KHUSUS SAHAJA), SEARCHING (SELECT2), PELAJAR ATAU STAFF (BILA SEARCH) --}}