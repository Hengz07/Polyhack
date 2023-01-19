@extends('adminlte::page')

@section('title', $title ?? "")

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Question</h1></div>
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
            {{-- TRANSLATION --}}
            @php

                if(app()->currentLocale() == 'ms-my')
                {
                    $code    = 'Kod';
                    $soalan  = 'Soalan';
                    $version = 'Versi';
                    $section = 'Seksyen';
                    $action  = 'Tindakan';
                }
                
                elseif(app()->currentLocale() == 'en')
                {
                    $code    = 'Code';
                    $soalan  = 'Questions';
                    $version = 'Versions';
                    $section = 'Section';
                    $action  = 'Actions';
                }
            
            @endphp

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
                            @if(app()->currentLocale() == 'ms-my')
                                <th style="min-width:200px"> SOALAN </th>
                            @elseif(app()->currentLocale() == 'en')
                                <th style="min-width:200px"> QUESTION </th>
                            @endif
                        </tr>
                    </thead>
                </table>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-navy bg-navy">
                        <tr class="text-center">
                            <th style="width:4%"> # </th>
                            <th style="width:7%"> {{ $code }} </th>
                            <th style="width:55%"> {{ $soalan }} </th>
                            <th style="width:7%"> {{ $version }} </th>
                            <th style="width:7%"> {{ $section }} </th>
                            <th style="width:10%"> {{ $action }} </th>
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
                                        @if(app()->currentLocale() == 'ms-my')
                                            {{ $item['value_local'] }}
                                        @elseif(app()->currentLocale() == 'en')
                                            {{ $item['value_translation'] }}
                                        @endif
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