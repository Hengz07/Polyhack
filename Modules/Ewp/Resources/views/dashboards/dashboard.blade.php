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
            {{-- TRANSLATION --}}
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
                @if (auth()->user()->hasRole(['SiteAdmin', 'Superadmin', 'ModuleAdmin', 'EwpOfficer']))
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
                                                    
                                                    <a type="button" id="modal-button" class="px-2 btn btn-dark btn-sm fa-list-alt fa-2 fas getResult"></a> 
                                                </div> 
                                            @endif
                                            <dialog id="modal">
                                                <div class="card direct-chat direct-chat-primary">
                                                <div class="card-header">
                                                <h3 class="card-title">Direct Chat</h3>
                                                <div class="card-tools">
                                                <span title="3 New Messages" class="badge badge-primary">3</span>
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" title="Contacts" data-widget="chat-pane-toggle">
                                                <i class="fas fa-comments"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" id="modal-close" data-card-widget="remove">
                                                <i class="fas fa-times"></i>
                                                </button>
                                                </div>
                                                </div>

                                                <div class="card-body">

                                                <div class="direct-chat-messages">

                                                <div class="direct-chat-msg">
                                                <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-left">Alexander Pierce</span>
                                                <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                                </div>

                                                <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">

                                                <div class="direct-chat-text">
                                                Is this template really for free? That's unbelievable!
                                                </div>

                                                </div>


                                                <div class="direct-chat-msg right">
                                                <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-right">Sarah Bullock</span>
                                                <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                                </div>

                                                <img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">

                                                <div class="direct-chat-text">
                                                You better believe it!
                                                </div>

                                                </div>


                                                <div class="direct-chat-msg">
                                                <div class="direct-chat-infos clearfix">
                                                <span class="direct-chat-name float-left">Alexander Pierce</span>
                                                <span class="direct-chat-timestamp float-right">23 Jan 5:37 pm</span>
                                                </div>

                                                <img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">

                                                <div class="direct-chat-text">
                                                Working with AdminLTE on a great new app! Wanna join?
                                                </div>
                                                </div>
                                            </dialog>

                                        </td>
                                    </tr> 
                                @endforeach
                                
                            @endif
                        </tbody>
                    </table>
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
        </script>
        
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
