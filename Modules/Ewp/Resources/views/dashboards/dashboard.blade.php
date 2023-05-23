@extends('adminlte::page')

@section('content_header')

<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<style>
    .btn-primary{
        color: #fff;
        background-color: #1D3456;
        border-color: #1D3456;
    }
    .btn-primary:hover{
        color: #fff;
        background-color: #346FB3;
        border-color: #346FB3;
        box-shadow: rgb(23 24 25 / 50%) -2px 2px 6px 0px, rgb(28 29 30 / 50%) 0px 0px 0px 0px;
    }

    .tblrep{
        background: #E3E6EB;
        color: #192F59;
    }

    #scrollToTopButton {
        position: fixed;
        bottom: 8rem;
        right: 1.5rem;
        z-index: 9999;
        background: red;
        border:none;
    }

</style>

<div class="d-flex">
    <div class="mr-auto p-3 ml-5"><h1>UM Dashboard</h1></div>
        <div class="p-3 mr-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

@php

    if(app()->currentLocale() == 'ms-my')
    {
        $sessem = 'Semester';
        $year   = 'Tahun Akademik';

        $date   = 'Tarikh Penilaian';
        $status   = 'Status';

        $teststart = 'Penilaian EWP';
        $action = 'Tindakan';
    }
    
    elseif(app()->currentLocale() == 'en')
    {
        $sessem = 'Semester';
        $year   = 'Academic Year';

        $date   = 'Assessment Date';
        $status   = 'Status';

        $teststart = 'EWP Assessment';
        $action = 'Action';
    }

@endphp

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 pl-5 pr-5 my-4"> 
            <div class="card card-body m-0 p-2 py-3">
                <div class="row m-0 p-0">
                    <div class="col-sm-3 card-body my-auto">
                        <button id="chatButton" class="btn btn-primary p-3 w-100" data-toggle="modal" data-target="#chatModal">Chat with Caunsellor</button>
                    </div>

                    <div class="col-sm-3 card-body my-auto">
                        @if(app()->currentLocale() == 'ms-my')
                                <table>
                                    <tr>
                                        <td><i class="las la-university pr-3" style="font-size: 40px;"></i></td>
                                        <td class="mr-2">Seksyen Pengurusan Psikologi & Kaunseling</td>
                                    </tr>
                                </table>
                        @elseif(app()->currentLocale() == 'en')
                                <table>
                                    <tr>
                                        <td><i class="las la-university pr-3" style="font-size: 40px;"></i></td>
                                        <td>Section of Psychology Management & Counseling</td>
                                    </tr>
                                </table>
                        @endif
                    </div>

                    <div class="col-sm-3 card-body my-auto">
                        @if(app()->currentLocale() == 'ms-my')
                                <table>
                                    <tr>
                                        <td><i class="las la-map-marker-alt pr-3" style="font-size: 40px;"></i></td>
                                        <td>Blok D Aras 1, Kompleks Peradanasiswa Universiti Malaya.</td>
                                    </tr>
                                </table>
                        @elseif(app()->currentLocale() == 'en')
                                <table>
                                    <tr>
                                        <td><i class="las la-map-marker-alt pr-3" style="font-size: 40px;"></i></td>
                                        <td>Level 1, Block D, Kompleks Perdanasiswa, Universiti Malaya.</td>
                                    </tr>
                                </table>
                        @endif
                    </div>

                    <div class="col-sm-3 card-body my-auto">
                        <table>
                            <tr>
                                <td><i class="las la-phone pr-3" style="font-size: 40px;"></i></td>
                                <td>03-79673244</br>03-79673322</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="modal" id="chatModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Chat Session</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Add your chat session content here -->
                                <p>This is the chat session content.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                    
            </div>
        </div>

        <script>
            const modalButton = document.querySelector('#modal-button');
            const modal = document.querySelector('#modal');
            const modalClose = document.querySelector('#modal-close');
            
            modalButton.addEventListener('click', () => {
                modal.showModal();
            });
            
            modalClose.addEventListener('click', () => {
                modal.close();
            });

            $(function() {
                $('#chatButton').click(function() {
                    $('#chatModal').modal('show');
                });
            });
        </script>
        
        <div class="col-sm-12 pl-5 pr-5 my-4">
            <div class="card">
                <div class="card-header" style="cursor: move; background: #E3E6EB; color:#001f3f;">
                <h3 class="card-title p-2 text-bold">Emotional-Wellbeing Profiling Record</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive px-5 py-4">
                
                <table class="table table-hover text-nowrap mb-2">
                    <thead>
                        <tr>
                            <td colspan="6">
                                @foreach ($reports as $report => $rep)
                                @endforeach

                                {{-- Start Test --}}
                                @if(isset($schedules))
                                
                                    @if(!isset($rep) || $rep['status'] != 'C' || $rep['session'] != $schedules['session'] || $rep['sem'] != $schedules['semester'])
                                        <a type="button" class="btn btn-primary showReport float-right mb-2 p-3 text-wrap" style="width:12rem;" data-route="ewp/dashboards/reports" id="btn2" data-title="Report" data-toggle="modal" title="Save">{{ $teststart }}</a>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    </thead>

                    <thead>
                        <tr>
                            <th> </th>
                            <th> {{ $year }} </th>
                            <th> {{ $sessem }} </th>
                            <th> {{ $date }} </th>
                            <th> {{ $status }} </th>
                            <th><div class="float-right"> {{ $action }} </div></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($reports) == 0)
                            <td style="text-align: center" colspan="6">No data availables</td>
                        @else
                        
                            @foreach ($reports as $report => $rep)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $rep['session'] }}</td>
                                    @if(auth()->user()->user_type == 'student')
                                        <td>{{ $sessem }} {{ $rep['sem'] }}</td>
                                    @else
                                        <td> ~ </td>
                                    @endif
                                    <td>{{ date('d/m/Y', strtotime($rep['created_at'])) }}</td>
                                    <td>
                                                            
                                        @if($rep['status'] != 'C')
                                            Scheduled
                                        @else
                                            Done
                                        @endif
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            <a type="button" id="modal-button" class="px-2 btn btn-sm getResult p-0 m-0"><i class="las la-eye" style="font-size: 32px;"></i></a>
                                        </div>
                                    </td>
                                </tr> 
                            @endforeach
                            
                        @endif
                    </tbody>
                </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

        <div class="col-sm-12 pl-5 pr-5 my-4">
            <div class="card">
                <div class="card-header" style="cursor: move; background: #E3E6EB; color:#001f3f;">
                <h3 class="card-title p-2 text-bold">Emotional-Wellbeing Profiling Result</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive px-5 py-4">
                
                    <div class="row">

                        <div class="col-sm-4 my-auto">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                        </div>
                        
                        <div class="col-sm-8 my-auto">
                            <figure class="highcharts-figure col-sm">
                                <div id="container"></div>
                                
                                {{-- <p class="highcharts-description">
                                    A spiderweb chart shows the test results of the Emotional-Wellbeing Profiling (EWP) test that has been answered by users (student/staffs).
                                </p> --}}
                            </figure>
                        </div>
                    </div>
                
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

<button id="scrollToTopButton" class="btn btn-primary float-right"><i class="las la-angle-up"></i></button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const scrollToTopButton = document.getElementById('scrollToTopButton');

    scrollToTopButton.addEventListener('click', function() {
        scrollToTop();
    });

    // Function to scroll the page to the top
    function scrollToTop() {
        // Scroll smoothly to the top of the page
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
    });
</script>

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
