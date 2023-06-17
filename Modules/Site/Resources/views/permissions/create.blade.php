@extends('adminlte::page')

@section('title', 'Create New Permission')
@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Create new permission</h1></div>
    <div class="p-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('site.permissions.index') }}">Access Controls</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create new permission</li>
            </ol>
        </nav>
    </div>
</div>
@stop
@section('content')
<div class="container-fluid">
    {!! Form::open(array('route' => 'site.permissions.store','method'=>'POST')) !!}
    <div class="card">
        <div class="card-body">
            
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-3">
                    <h5>Permission Information</h5>
                    <p class="text-muted">Provide permission information</p>
                </div>
                <div class="col-lg-9">
                    <div class="form-group">
                        <label for="inputText">Group</label>
                        {!! Form::select('parent_id', $permissions, null, ['class'=> 'form-control select2', 'placeholder' => '- None -']) !!}
                        
                        <small id="emailHelp" class="form-text text-muted">Leave empty to create group</small>
                    </div>
                
                    <div class="form-group">
                        <label>Name</label>
                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                    </div>
                </div>
            </div>
            
            
            
            <div class="text-right">
                <a class="btn btn-default" href="{{ route('site.permissions.index') }}"> CANCEL</a>
                <button type="submit" class="btn btn-primary">CREATE</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>

@endsection

@push('js')
    <script src="{{ asset('js/select.js') }}"></script>
@endpush
