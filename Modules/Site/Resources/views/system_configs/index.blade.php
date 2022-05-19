@extends('adminlte::page')

@section('title', config('app.name') . ' - System Config')

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>System Config</h1></div>
    <div class="p-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">System Config</li>
            </ol>
        </nav>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    {!! Form::open(array('route' => 'site.system-configs.store','method'=>'POST')) !!}
    <div class="card">
        <div class="card-body">
            @include('site::system_configs._formPartial')
        </div>
        <div class="card-footer">
            <div class="text-right">
                <button type="submit" class="btn btn-primary">SAVE</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection