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
                    <a href="/ewp/dashboards/admin_dash">
                        <button type="button" class="btn btn-warning">
                            Admin
                        </button>
                    </a>
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
                                        <th style="width:5%"> # </th>
                                        <th style="width:10%"> Session / Semester </th>
                                        <th style="width:10%"> Date </th>
                                        <th style="width:10%"> Status </th>
                                    </tr>
                                </thead>
            
                                <tbody>
                                    @for ($i = 0; $i < 5; $i++)
                                    <tr class="text-center">
                                        <td> 1 </td> 
                                        <td> 2021/2022 1 </td>
                                        <td> 20-MAY-22 </td>
                                        <td> UMUM </td>
                                    </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
            
            <div class="card col-sm-7">
                <div class="card-header">
                    {{-- <div class="{{ config('adminlte.card_default') }}"> --}}
                        <div class="card-body">
                            <h2 class="text-center"> Emotional-Wellbeing Profiling Result </h2> <br>
                            <div>
                                <figure class="highcharts-figure">
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