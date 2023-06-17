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
