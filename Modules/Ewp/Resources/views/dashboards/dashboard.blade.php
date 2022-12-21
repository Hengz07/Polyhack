@extends('adminlte::page')

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Dashboard</h1></div>
        <div class="p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="card bg-navy col-sm-12">
            @php

                if(app()->currentLocale() == 'ms-my')
                {
                    $sessem = 'Sesi / Semester';
                    $year   = 'Tahun';

                    $date   = 'Tarikh';
                    $status   = 'Status';

                    $teststart = 'Mulakan Ujian';
                }
                
                elseif(app()->currentLocale() == 'en')
                {
                    $sessem = 'Session / Semester';
                    $year   = 'Year';

                    $date   = 'Date';
                    $status   = 'Status';

                    $teststart = 'Start Test';
                }
            
            @endphp

            <span class="card-header">
                @if (auth()->user()->hasRole(['SiteAdmin', 'SuperAdmin']))
                    <a href="/ewp/dashboards/admin_dash">
                        <button type="button" class="btn btn-info">
                            Admin
                        </button>
                    </a>
                @endif
                
                @foreach ($reports as $report => $rep)
                @endforeach

                {{-- Start Test --}}
                @if(isset($schedules))
                    @if(!isset($rep) || $rep['status'] != 'C' || $rep['session'] != $schedules['session'] || $rep['sem'] != $schedules['semester'])
                        <a type="button" class="btn btn-primary showReport" data-route="ewp/dashboards/reports" 
                            id="btn2" data-title="Report" data-toggle="modal" title="Save">{{ $teststart }}</a>

                        <label class="float-right text-white">
                            {{ $schedules['session'] }} / {{ $schedules['semester'] }}
                        </label>
                    @endif
                @endif
                {{--  --}}
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 pl-0"> 
            <div class="card card-body mr-1">
                <h2> Report </h2> 
                <br><br>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead class="thead-navy bg-navy">
                            <tr class="text-center">
                                <th style="width:5%" class="text-center"> # </th>
                                @if(auth()->user()->user_type == 'student')
                                    <th style="width:15%" class="text-center"> {{ $sessem }} </th>
                                @else
                                    <th style="width:15%" class="text-center"> {{ $year }} </th>
                                @endif
                                <th style="width:10%" class="text-center"> {{ $date }} </th>
                                <th style="width:10%" class="text-center"> {{ $status }} </th>
                            </tr>
                        </thead>

                        <tbody>
                            @if (count($reports) == 0)
                                <td style="text-align: center" colspan="8">No data availables</td>
                            @else
                            
                                @foreach ($reports as $report => $rep)
                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>
                                        @if(auth()->user()->user_type == 'student')
                                            <td class="text-center">{{ $rep['session'] }} - {{ $rep['sem'] }}</td>
                                        @else
                                            <td class="text-center">{{ $rep['session'] }}</td>
                                        @endif
                                        <td class="text-center">{{ date('d/m/Y', strtotime($rep['created_at'])) }}
                                        <td class="text-center">
                                                                
                                            @if($rep['status'] != 'C')
                                                <div class="d-inline-flex row mx-2">
                                                    <span class="px-2 text-center font-weight-bold bg-secondary text-white rounded">
                                                        In Progress
                                                    </span> 
                                                </div>
                                                
                                            @else
                                                <div class="d-inline-flex mx-2">
                                                    <span class="px-2 text-center font-weight-bold bg-success text-white rounded">
                                                        Done
                                                    </span>

                                                    &nbsp; 
                                                    
                                                    <a type="button" class="px-2 btn btn-dark btn-sm fa-list-alt fa-2 fas getResult"></a> 
                                                </div> 
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
        
        <div class="col-sm-6 pr-0">
            <div class="card card-body ml-1">
                <h2 class="text-center"> Emotional-Wellbeing Profiling Result </h2> <br>
                <div class="col-sm">
                    <figure class="highcharts-figure col-sm">
                        <div id="container"></div>
                        
                        {{-- <p class="highcharts-description">
                            A spiderweb chart shows the test results of the Emotional-Wellbeing Profiling (EWP) test that has been answered by users (student/staffs).
                        </p> --}}
                    </figure>
                </div>
            </div>
        </div>

        <div class="card bg-light col-sm-12">
            <span class="card-body">
                @if(app()->currentLocale() == 'ms-my')
                    <h5 class="font-weight-bold text-dark">
                        Seksyen Pengurusan Psikologi & Kaunseling
                    </h5>
                    <label class="small text-black">
                        Blok D Aras 1, Kompleks Peradanasiswa Universiti Malaya.
                    </label>

                @elseif(app()->currentLocale() == 'en')
                    <h5 class="font-weight-bold text-dark">
                        Section of Psychology Management & Counseling
                    </h5>
                    <label class="small text-black">
                        Level 1, Block D, Kompleks Perdanasiswa, Universiti Malaya.
                    </label>
                @endif

                <br><br>

                <i class="fa fa-phone" aria-hidden="true"></i>
                <label class="font-weight-bold text-black">&nbsp; 03-79673244 / 3322</label>
                
            </span>
        </div>
    </div>
</div>
@include('layouts.delete')
@include('layouts.modal')

@endsection

@section('css')
    <link href="{{ asset('css/spiderchart.css') }}" rel="stylesheet">
@endsection

@section('js') 
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/select_modal.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
    <script src="{{ asset('js/spiderchart.js') }}"></script>
@endsection
