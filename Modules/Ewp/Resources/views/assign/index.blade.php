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
    
    @include('ewp::assign.assignsearching')

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
            
            <div class="table-responsive col col-md">
                <table class="table table-hover table-bordered">
                    <thead class="thead-navy bg-navy">
                        <tr class="text-center">
                            <th style="width: 2em"> # </th>
                            <th style="width: 2em"> Session </th>
                            <th style="width: 2em"> ID </th>
                            <th style="width: 2em"> Name </th>
                            <th style="width: 2em"> Faculty </th>
                            <th class="text-center" style="width: 2em"> {{ $D = 'D' }} </th>
                            <th class="text-center" style="width: 2em"> {{ $A = 'A' }} </th>
                            <th class="text-center" style="width: 2em"> {{ $S = 'S' }} </th>
                            <th style="width: 2em"> Status </th>
                            <th style="width: 2em"> Date </th>
                            <th style="width: 8%"> Officer </th>
                            <th style="width: 2em"> 
                                <div class="d-inline-flex input-group justify-content-center">
                                    <label class="icheck-primary icheck-inline">
                                        <input type="checkbox" id="checkboxCheckAll" class="chk-box" />
                                        <label for="checkboxCheckAll"></label>
                                    </label>
                                    
                                    {{-- <div class=""> --}}
                                        

                                    <a class="{{ config("adminlte.btn_default") }} btn bg-warning" id="saveall"
                                        data-route="ewp/assign/create" data-title="Officer" 
                                        data-toggle="modal"><i class="fa fa-share" style="width: 12px;"></i></a> 
                                    {{-- </div> --}}
                                </div>
                            </th>
                            <th style="width: 10%"> Action </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @if (count($reports) == 0)
                            <td style="text-align: center" colspan="13">No data availables</td>
                        @else
                            @foreach ($reports as $report => $rep)
                                
                                @php
                                    $profile = $rep['profile']; 
                                    // dd($profile);
                                    $desc = $profile['ptj'];
                                    // dd($desc);
                                    $user    = $profile['user'];
                                    $assign  = $rep['assign'];

                                    $scale = $rep['scale'];
                                    // dd($rep);
                                @endphp

                                <tr>
                                    <td class="text-center"> {{ ++$i }} </td>
                                    <td class="text-center"> {{ $rep['session'] }} - {{ $rep['sem'] }} </td> 
                                    <td class="text-center"> {{ $profile['profile_no'] }} </td> 
                                    <td class="text-center"> {{ $user['name'] }} </td> 
                                    {{-- <td class="text-center"> {{ $desc[0]['desc']}} </td> --}}
                                    <td class="text-center"> {{$profile['ptj'][0]['desc']}}</td> 
                                    
                                    

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
                                                                    <label class="badge badge-danger px-3  py-3 w-100" style="font-size:16px;">{{ $scale[$up]['value'] }}</label>
                                                                @else
                                                                    <label class="badge badge-success px-3 py-3 w-100" style="font-size:16px;">{{ $scale[$up]['value'] }}</label>
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
                                        
                                        @if(isset($assign))
                                            @foreach($officers as $officer)
                                                @if($assign['officer_id'] == $officer['id'])
                                                    {{ $officer['name'] }}
                                                @endif
                                            @endforeach
                                        @else 
                                            <label>None</label>
                                        @endif

                                    </td>
                                    <td class="text-center">

                                        @if(isset($assign))
                                            @if ($assign['meta'] == null && $intervention == 'INTERVENSI KHUSUS')
                                                <div class="icheck-primary icheck-inline">
                                                    <input type="checkbox" class="chk_box_sub" id="{{ $rep['id'] }}" value="{{ $rep['id'] }}" />
                                                    <label for="{{ $rep['id'] }}"></label>
                                                </div>
                                            @else
                                                <label>--</label>
                                            @endif
                                        @endif

                                    </td>
                                    <td class="text-center">
                                        
                                        @php

                                        $ok = 1;

                                        @endphp
                                        @if(isset($assign))
                                            @if($assign['status'] == 'S')

                                                <a class="{{ config("adminlte.btn_edit") }} btn showSaringanInfo bg-success" 
                                                data-route="ewp/assign" data-id="{{ $rep->id }}" data-title=" Information" 
                                                data-toggle="modal" title="SELESAI" style="display: block; margin-bottom:0.3em;"><i class="fas fa-check-circle px-2 py-2" style="font-size: 18px;" ></i></a>

                                                <a class="{{ config("adminlte.btn_edit") }} btn showSurveyAnswer bg-danger" 
                                                data-route="ewp/assign" data-id="{{ $rep->id }}" data-title=" Answer" 
                                                data-toggle="modal" style="display: block; margin-bottom:0.3em;"><i class="fas fa-question-circle px-2 py-2" style="font-size: 18px;" ></i></a>
                                                
                                            @elseif($assign['status'] == 'R')

                                                <a class="{{ config("adminlte.btn_edit") }} btn showSaringanInfo bg-warning" 
                                                data-route="ewp/assign" data-id="{{ $rep->id }}" data-title=" Information" 
                                                data-toggle="modal" title="RUJUK" style="display: block; margin-bottom:0.3em;" ><i class="fas fa-hospital px-2 py-2" style="font-size: 18px;" ></i></a>

                                                <a class="{{ config("adminlte.btn_edit") }} btn showSurveyAnswer bg-danger" 
                                                    data-route="ewp/assign" data-id="{{ $rep->id }}" data-title=" Answer" 
                                                    data-toggle="modal" style="display: block; margin-bottom:0.3em;"><i class="fas fa-question-circle px-2 py-2" style="font-size: 18px;" ></i></a>
                                                    
                                            @else
                                            
                                                <a class="{{ config("adminlte.btn_edit") }} btn showSaringanInfo bg-info" 
                                                data-route="ewp/assign" data-id="{{ $rep->id }}" data-title=" Information" 
                                                data-toggle="modal" style="display: block; margin-bottom:0.3em;"><i class="fas fa-user-circle px-2 py-2" style="font-size: 18px;" ></i></a>

                                                <a class="{{ config("adminlte.btn_edit") }} btn showSurveyAnswer bg-danger" 
                                                    data-route="ewp/assign" data-id="{{ $rep->id }}" data-title=" Answer" 
                                                    data-toggle="modal" style="display: block; margin-bottom:0.3em;"><i class="fas fa-question-circle px-2 py-2" style="font-size: 18px;" ></i></a>

                                            @endif
                                        @endif
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
    <script src="{{ asset('js/delete.js') }}"></script>
    <script src="{{ asset('js/assign.js') }}"></script>
@endsection

{{-- KERJA --}}
{{-- SIMPAN ASSIGN, KELUARKAN INFORMATION, CHECKBOX (BUNDLE DAN SINGLE, PAPARKAN UNTUK KHUSUS SAHAJA), SEARCHING (SELECT2), PELAJAR ATAU STAFF (BILA SEARCH) --}}