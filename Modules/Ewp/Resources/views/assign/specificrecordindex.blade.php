@extends('adminlte::page')

@section('title', $title ?? "")

@section('content_header')
<div class="d-flex">    
    <div class="mr-auto p-2"><h1>Rekod Khusus</h1></div>
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
    
    @if (auth()->user()->hasRole(['Superadmin', 'ModuleAdmin']))
    @include('ewp::assign.assignsearching', ['specific' => true])
    @elseif (auth()->user()->hasRole(['EwpOfficer']))
    @include('ewp::assign.assignsearching')
    @endif

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
                                <th style="min-width:200px"> REKOD KHAS </th>
                            @elseif(app()->currentLocale() == 'en')
                                <th style="min-width:200px"> SPECIFIC RECORD </th>
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
                            <th style="width: 14%"> Name </th>
                            <th style="width: 7%"> D </th>
                            <th style="width: 7%"> A </th>
                            <th style="width: 7%"> S </th>
                            <th style="width: 7%"> Status </th>
                            <th style="width: 7%"> Assign Date </th>
                            <th style="width: 10%"> Action </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    @if (auth()->user()->hasRole(['Superadmin','SiteAdmin']))
                        @if (count($reportss) == 0)
                            <td style="text-align: center" colspan="11">No data availables</td>
                        @else
                            @foreach ($reportss as $report => $rep)
                                
                                @php
                                    $profile = $rep['profile'];
                                    $user = $profile['user'];
                                    $assign = $rep['assign'];

                                    $scale = $rep['scale'];
                                @endphp
                                
                                @if ($scale['A']['status']['intervention'] == 'INTERVENSI KHUSUS' || $scale['D']['status']['intervention'] == 'INTERVENSI KHUSUS' || $scale['S']['status']['intervention'] == 'INTERVENSI KHUSUS')
                                    <tr>
                                        <td class="text-center"> {{ ++$i }} </td>
                                        <td class="text-center"> {{ $rep['session'] }} - {{ $rep['sem'] }} </td>
                                        <td class="text-center"> {{ $user['name'] }} </td>
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
                                        <td class="text-center"> 
        
                                            @php
                                                if ($scale['A']['status']['intervention'] == 'INTERVENSI KHUSUS' || 
                                                    $scale['D']['status']['intervention'] == 'INTERVENSI KHUSUS' || 
                                                    $scale['S']['status']['intervention'] == 'INTERVENSI KHUSUS')
                                                {
                                                    $intervention = 'Special Intervention';
                                                }
                                                
                                                else
                                                {
                                                    $intervention = 'Normal';
                                                }  
                                            @endphp
                                            {{ $intervention }}

                                        </td>
                                        <td class="text-center"> {{ date('d/m/Y', strtotime($rep['created_at'])) }} </td>
                                        <td class="text-center"> 

                                        @if(isset($assign))
                                            @if($assign['meta'] == null)
                                            <a class="{{ config("adminlte.btn_edit") }} btn showSaringanInfo bg-info" 
                                                data-route="ewp/assign" data-id="{{ $rep->id }}" data-title="Information" 
                                                data-toggle="modal"><i class="fa fa-id-badge" style="width: 12px;"></i></a>
                                            @else
                                             <a class="{{ config("adminlte.btn_edit") }} btn showSaringanInfo bg-success" 
                                                data-route="ewp/assign" data-id="{{ $rep->id }}" data-title="Information" 
                                                data-toggle="modal"><i class="fa fa-id-badge" style="width: 12px;"></i></a>
                                            @endif 
                                        @else
                                        <a class="{{ config("adminlte.btn_edit") }} btn showSaringanInfo bg-info" 
                                            data-route="ewp/assign" data-id="{{ $rep->id }}" data-title="Information" 
                                            data-toggle="modal"><i class="fa fa-id-badge" style="width: 12px;"></i></a>
                                        @endif 

                                            <button type="button" class="btn btn-sm {{ config('adminlte.btn_default') }} bg-danger">
                                                <i class="fa fa-file"></i></button> 
                                                {{-- consideration  --}}
                                            
                                            <a class="{{ config("adminlte.btn_default") }} btn-sm showSummary bg-warning"
                                                data-route="ewp/assign" data-title="Summary" 
                                                data-toggle="modal" data-id="{{ $rep['id'] }}"><i class="fas fa-comment"></i></a>

                                        </td> 
                                    </tr> 
                                @endif 
                            @endforeach
                        @endif
                    @else
                        @if (count($reports) == 0)
                            <td style="text-align: center" colspan="11">No data availables</td>
                        @else
                            @foreach ($reports as $report => $rep)
                                
                                @php
                                    $profile = $rep['profile'];
                                    $user = $profile['user'];
                                    $assign = $rep['assign'];

                                    $scale = $rep['scale'];
                                @endphp
                                
                                @if ($scale['A']['status']['intervention'] == 'INTERVENSI KHUSUS' || $scale['D']['status']['intervention'] == 'INTERVENSI KHUSUS' || $scale['S']['status']['intervention'] == 'INTERVENSI KHUSUS')
                                    <tr>
                                        <td class="text-center"> {{ ++$i }} </td>
                                        <td class="text-center"> {{ $rep['session'] }} - {{ $rep['sem'] }} </td>
                                        <td class="text-center"> {{ $user['name'] }} </td> 
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
                                        <td class="text-center"> 
        
                                            @php
                                                if ($scale['A']['status']['intervention'] == 'INTERVENSI KHUSUS' || 
                                                    $scale['D']['status']['intervention'] == 'INTERVENSI KHUSUS' || 
                                                    $scale['S']['status']['intervention'] == 'INTERVENSI KHUSUS')
                                                {
                                                    $intervention = 'Special Intervention';
                                                }
                                                
                                                else
                                                {
                                                    $intervention = 'Normal';
                                                }  
                                            @endphp
                                            {{ $intervention }}

                                        </td>
                                        <td class="text-center"> {{ date('d/m/Y', strtotime($rep['created_at'])) }} </td>
                                        <td class="text-center"> 

                                        @if(isset($assign))
                                            @if($assign['meta'] == null)
                                            <a class="{{ config("adminlte.btn_edit") }} btn showSaringanInfo bg-info" 
                                                data-route="ewp/assign" data-id="{{ $rep->id }}" data-title="Information" 
                                                data-toggle="modal"><i class="fa fa-id-badge" style="width: 12px;"></i></a>
                                            @else
                                             <a class="{{ config("adminlte.btn_edit") }} btn showSaringanInfo bg-success" 
                                                data-route="ewp/assign" data-id="{{ $rep->id }}" data-title="Information" 
                                                data-toggle="modal"><i class="fa fa-id-badge" style="width: 12px;"></i></a>
                                            @endif 
                                        @else
                                        <a class="{{ config("adminlte.btn_edit") }} btn showSaringanInfo bg-info" 
                                            data-route="ewp/assign" data-id="{{ $rep->id }}" data-title="Information" 
                                            data-toggle="modal"><i class="fa fa-id-badge" style="width: 12px;"></i></a>
                                        @endif 

                                            <button type="button" class="btn btn-sm {{ config('adminlte.btn_default') }} bg-danger">
                                                <i class="fa fa-file"></i></button> 
                                            
                                            <a class="{{ config("adminlte.btn_default") }} btn-sm showSummary bg-warning"
                                                data-route="ewp/assign" data-title="Summary" 
                                                data-toggle="modal" data-id="{{ $rep['id'] }}"><i class="fas fa-comment"></i></a>

                                        </td> 
                                    </tr> 
                                @endif 
                            @endforeach
                        @endif
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
    <script src="{{ asset('js/assign.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection


{{-- KERJA --}}
{{-- SIMPAN ASSIGN, KELUARKAN INFORMATION, CHECKBOX (BUNDLE DAN SINGLE, PAPARKAN UNTUK KHUSUS SAHAJA), SEARCHING (SELECT2), PELAJAR ATAU STAFF (BILA SEARCH) --}}     