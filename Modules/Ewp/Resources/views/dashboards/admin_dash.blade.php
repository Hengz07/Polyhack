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
            </div>
        </section>
    </body>
</div>

@endsection