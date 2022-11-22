@extends('adminlte::page')

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Student Dashboard</h1></div>
        <div class="p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li> --}}
                    {{-- <li class="breadcrumb-item active" aria-current="page">Dashboard</li> --}}
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

<div class="container-fluid">
        <div class="row mb-3">
            <div class="card col-sm-5">
                <div class="card-header">
                    @if (auth()->user()->hasRole(['SiteAdmin', 'SuperAdmin']))
                        <a href="/ewp/dashboards/admin_dash">
                            <button type="button" class="btn btn-warning">
                                Admin
                            </button>
                        </a>
                    @endif
                    {{-- Start Test --}}
                    <a type="button" class="btn btn-primary showReport" data-route="ewp/dashboards/reports" 
                        id="btn2" data-title="Report" data-toggle="modal" title="Save">Start Test</a>
                    {{--  --}}
                </div>

                {{-- <div class="{{ config('adminlte.card_default') }}"> --}}
                    <div class="card-body"> <br><br>
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
                                    {{-- TAKEN FROM SCHEDULES --}}
                                    @if (count($schedules) == 0)
                                        <td style="text-align: center" colspan="8">No data availables</td>
                                    @else
                                        @foreach ($schedules as $sch)
                                            <tr>
                                                <td class="text-center">{{ ++$i }}</td>
                                                <td class="text-center">{{ $sch['session'] }} - {{ $sch['semester'] }}</td>
                                                <td class="text-center">{{ date('d/m/Y') }}
                                                <td class="text-center">

                                                    @if(count($reports) == 0)
                                                        <div class="mx-4 font-italic bg-danger text-white rounded">
                                                            NOT COMPLETED
                                                        </div>
                                                    @else
                                                        @foreach($report as $rep)

                                                            @if ($rep['status'] == '' || count($report) == 0)
                                                                <div class="mx-4 font-italic bg-danger text-white rounded">
                                                                    NOT COMPLETED
                                                                </div>
                                                            @elseif($rep['status'] == 'V')
                                                                <div class="mx-4 font-italic bg-warning text-white rounded">
                                                                    IN PROGRESS
                                                                </div>
                                                            @else
                                                                <span class="mx-4 font-italic bg-success text-white rounded">
                                                                    Done
                                                                    &nbsp; 
                                                                </span>
                                                                <button class='btn btn-primary showResult'><i class="fas fa-list-alt" aria-hidden="true"></i></button>  
                                                            @endif

                                                        @endforeach
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
            
            <div class="card col-sm-7">
                <div class="card-body">
                    {{-- <div class="{{ config('adminlte.card_default') }}"> --}}
                        <div class="card-body">
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
                    {{-- </div> --}}
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