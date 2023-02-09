@extends('adminlte::page')

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Dashboard</h1></div>
        <div class="p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.index') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

<div class="container-fluid">
    <br>
    <body>
        <section class="ftco-section">
            {{-- Header/Title & Manual/Start Test Button Section --}}
            <div class="card card-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
                            <a href={{ route('ewp.setup.questions') }}>
                                <div class="card bg-success">
                                    <div class="card-body">
                                        <h5><p class="mb-4 text-left text-white">Questions</p></h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-4">
                            <a href={{ route('setup.scale') }}>
                                <div class="card bg-warning">
                                    <div class="card-body">
                                        <h5><p class="mb-4 text-left text-white">Scales</p></h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-md-4">
                            <a href={{ route('ewp.setup.schedules') }}>
                                <div class="card bg-danger">
                                    <div class="card-body">
                                        <h5><p class="mb-4 text-left text-white">Schedules</p></h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header ui-sortable-handle" style="cursor: move;">
                    <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Sales
                    </h3>
                    <div class="card-tools">
                    <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                    <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                    </ul>
                    </div>
                    </div>
                    <div class="card-body">
                    <div class="tab-content p-0">
                    
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px; display: block; width: 503px;" width="503" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="0" style="height: 0px; display: block; width: 0px;" class="chartjs-render-monitor" width="0"></canvas>
                    </div>
                    </div>
                    </div>
                    </div>
                
            </div>
        </section>
    </body>
</div>

@endsection