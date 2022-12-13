@extends('adminlte::page')

@section('title', $title ?? "")

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>QUESTION</h1></div>
    <div class="p-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.admin_dash') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ "Question" }}</li>
            </ol>
        </nav>
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    <div class="{{ config('adminlte.card_default') }}">
        <div class="card-body"> 
            <div class="d-flex p-0">
                <div class="mr-auto">
                    {{-- Add Question --}}
                        <a type="button" class="btn btn-success showQuestion" data-route="ewp/setup/questions" 
                            id="btn2" data-title="Questions" data-toggle="modal" title="Add">
                            <i class="fa fa-plus"></i></a>
                    {{--  --}}
                </div>
                <div class="">
                    @include('widgets._searchForm')
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-navy bg-navy text-center">
                        <tr>
                            <th style="min-width:200px"> SKOR BAHAGIAN </th>
                        </tr>
                    </thead>
                </table>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-navy bg-navy">
                        <tr class="text-center">
                            <th style="width:4%"> # </th>
                            <th style="width:7%"> Code </th>
                            <th style="width:55%"> Questions </th>
                            <th style="width:7%"> Version </th>
                            <th style="width:7%"> Section </th>
                            <th style="width:10%"> Actions </th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @if (count($questions) == 0)
                            <td style="text-align: center" colspan="8">No data availables</td>
                        @else
                            @foreach ($questions as $lookup => $item)
                                <tr>
                                    <td class="text-center">{{ ++$i }}</td>
                                    <td class="text-center">{{ $item['code'] }}</td>
                                    <td>
                                        <b>{{ $item['value_local'] }}</b>
                                        <div class="text-primary font-italic text-sm">{{ $item['value_translation'] }}</div>
                                    </td>   
                                    
                                    @php 
                                        $meta = json_decode($item['meta_value'], true)
                                    @endphp

                                    <td class="text-center">
                                        {{ $meta['version'] }}
                                    </td>

                                    <td class="text-center">
                                        {{ $meta['name'] }}
                                    </td>
                                    
                                    <td class="text-center">
                                        {{-- Edit button --}}   
                                        <a class="{{ config("adminlte.btn_edit") }} btn showQuestion" 
                                            data-route="ewp/setup/questions" data-id="{{ $item->id }}" data-title="Questions" 
                                            data-toggle="modal"><i class="fa fa-edit"></i></a>
                                        
                                        {{-- Delete button --}}
                                        <button type="button" class="btn btn-sm {{ config('adminlte.btn_delete') }} sa-warning" 
                                            data-route="ewp/setup/questions" data-id="{{ $item->id }}" data-title="delete Questions">
                                            <i class="fa fa-trash"  title="Click to delete questions"></i></button>
                                    </td>
                                </tr>   
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{!! $questions->setPath('')->render() !!}

@include('layouts.delete')
@include('layouts.modal')

@endsection

@section('js') 
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/select_modal.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection