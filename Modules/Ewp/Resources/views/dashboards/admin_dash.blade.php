@extends('adminlte::page')

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Dashboard</h1></div>
        <div class="p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

<div class="container-fluid">

    <br>
    {{-- Table Design 2 --}}
    <body>
        <section class="ftco-section">
            {{-- Header/Title & Manual/Start Test Button Section --}}
                <div class="card card-body">
                    <div class="col-md-12 grid-margin transparent align-items-center justify-content-center">
                        <div class="row">
                            <div class="col-md-4 stretch-card transparent">
                                <a href={{ route('ewp.setup.questions') }}>
                                <div class="card bg-dark">
                                    <div class="card-body">
                                        <p class="mb-4 text-center text-white">Questions</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-md-4 stretch-card transparent">
                                <a href={{ route('setup.scale') }}>
                                <div class="card bg-dark">
                                    <div class="card-body">
                                        <p class="mb-4 text-center text-white">Scales</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                            
                            <div class="col-md-4 mb-lg-0 stretch-card transparent">
                                <a href={{ route('ewp.setup.schedules') }}>
                                <div class="card bg-dark">
                                    <div class="card-body">
                                        <p class="mb-4 text-center text-white">Schedules</p>
                                    </div>
                                </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </body>
</div>

@endsection