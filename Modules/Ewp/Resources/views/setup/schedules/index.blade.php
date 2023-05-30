{{-- NOTE FOR HABIEL -- FIX STAFF SCHEDULES SESSION DISPLAYING STUDENT FORMAT INSTEAD OF THE STAFF FORMAT --}}

@extends('adminlte::page')

@section('title', $title ?? "")

@section('content_header')
<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css"> 
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Schedule</h1></div>
    <div class="p-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.admin_dash') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ "Schedule" }}</li>
            </ol>
        </nav>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="{{ config('adminlte.card_default') }}">
        <div class="card-body">
            {{-- TRANSLATION --}}
            @php

                if(app()->currentLocale() == 'ms-my')
                {
                    $session    = 'Sesi';
                    $semester = 'Semester';
                    $category = 'Kategori';
                    $sdate = 'Tarikh Mula';
                    $edate  = 'Tarikh Tamat';
                    $action = 'Tindakan';
                }
                
                elseif(app()->currentLocale() == 'en')
                {
                    $session    = 'Session';
                    $semester = 'Semester';
                    $category = 'Category';
                    $sdate = 'Start Date';
                    $edate  = 'End Date';
                    $action = 'Actions';
                }
            
            @endphp 
            <div class="d-flex p-0">
                <div class="mr-auto">
                    {{-- Add Schedule --}}
                        <a type="button" class="btn btn-success showSchedule" data-route="ewp/setup/schedules" 
                            id="btn2" data-title="Schedules" data-toggle="modal" title="Add">
                            <i class="fa fa-plus"></i></a>
                    {{--  --}}
                </div>
                <div class="">
                    @include('widgets._searchForm')
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-navy bg-navy text-center">
                        <tr>
                            @if(app()->currentLocale() == 'ms-my')
                                <th style="min-width:200px"> JADUAL </th>
                            @elseif(app()->currentLocale() == 'en')
                                <th style="min-width:200px"> SCHEDULE </th>
                            @endif
                        </tr>
                    </thead>
                </table>
            </div>
    
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-navy bg-navy">
                        <tr>
                            <th style="width:5%" class="text-center"> # </th>
                            <th style="width:17.6%" class="text-center"> {{ $session }} </th>
                            <th style="width:17.6%" class="text-center"> {{ $semester }} </th>
                            <th style="width:17.6%" class="text-center"> {{ $category }} </th>
                            <th style="width:17.6%" class="text-center"> {{ $sdate }} </th>
                            <th style="width:17.6%" class="text-center"> {{ $edate }} </th>
                            <th style="width:7%" class="text-center"> {{ $action }} </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @if (count($schedules) == 0)
                            <td style="text-align: center" colspan="8">No data availables</td>
                        @else
                            @foreach ($schedules as $calendar => $sch)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-center">{{ $sch['session'] }}</td>
                                    <td class="text-center">{{ $sch['semester'] }}</td>
                                    <td class="text-center">{{ $sch['category'] }}</td>
                                    <td class="text-center">{{ date('d/m/Y', strtotime($sch['start_date'])) }}</td>  
                                    <td class="text-center">{{ date('d/m/Y', strtotime($sch['end_date'])) }}</td>
                                    <td class="text-center">
                                        {{-- Edit button --}}
                                        <a class="{{ config("adminlte.btn_edit") }} btn showSchedule" 
                                            data-route="ewp/setup/schedules" data-id="{{ $sch->id }}" data-title="Schedules" 
                                            data-toggle="modal"><i class="fa fa-edit"></i></a>
            
                                        {{-- Delete button --}}  
                                        <button type="button" class="btn btn-sm {{ config('adminlte.btn_delete') }} sa-warning" 
                                            data-route="ewp/setup/schedules" data-id="{{ $sch->id }}" data-title="delete Schedules" data-adopted="true">
                                            <i class="fa fa-trash"  title="Click to delete schedules"></i></button>
                                                
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
{!! $schedules->setPath('')->render() !!}

@include('layouts.delete')
@include('layouts.modal')

@endsection

@section('js') 
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/select_modal.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection