@extends('adminlte::page')

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Student Dashboard</h1></div>
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
                @if(count($reports) == 0 || $rep['status'] != 'C')
                    <a type="button" class="btn btn-primary showReport" data-route="ewp/dashboards/reports" 
                        id="btn2" data-title="Report" data-toggle="modal" title="Save">Start Test</a>
                                                
                    <label class="float-right text-white">
                        {{ $schedules->session }} / {{ $schedules->semester }}
                    </label>
                @endif
                {{--  --}}
            </span>
        </div>
    </div>

    <div class="row">
        <div class="card card-body col-sm-5"> <br><br>
            <h2 class="text-center"> Report </h2> <br><br>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-dark bg-dark">
                        <tr class="text-center">
                            <th style="width:5%" class="text-center"> # </th>
                            <th style="width:15%" class="text-center"> Session / Semester </th>
                            <th style="width:10%" class="text-center"> Date </th>
                            <th style="width:10%" class="text-center"> Status </th>
                        </tr>
                    </thead> 
                    
                    <tbody>
                        @if (count($reports) == 0)
                            <td style="text-align: center" colspan="8">No data availables</td>
                        @else
                        
                            @foreach ($reports as $report => $rep)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-center">{{ $rep['session'] }} - {{ $rep['sem'] }}</td>
                                    <td class="text-center">{{ date('d/m/Y') }}
                                    <td class="text-center">
                                                            
                                        @if($rep['status'] == 'V')
                                            <div class="d-inline-flex row mx-2">
                                                <span class="px-2 text-center font-weight-bold bg-secondary text-white rounded">
                                                    In Progress
                                                </span> 
                                            </div>
                                            
                                        @else
                                            <div class="d-inline-flex row mx-2">
                                                <span class="px-2 text-center font-weight-bold bg-success text-white rounded">
                                                    Done
                                                </span>

                                                &nbsp; 
                                                
                                                <a type="button" class="px-2 btn btn-dark btn-sm fa-list-alt fa-2 fas"></a> 
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
        
        <div class="col-sm-1 bg-light-navy"></div>
        <div class="card card-body col-sm-6">
                <h2 class="text-center"> Emotional-Wellbeing Profiling Result </h2> <br>
            <div>
                <figure class="highcharts-figure col-sm">
                    <div id="container"></div>
                    
                    <p class="highcharts-description">
                        A spiderweb chart shows the test results of the Emotional-Wellbeing Profiling (EWP) test that has been answered by users (student/staffs).
                    </p>
                </figure>
            </div>
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
