@extends('adminlte::page')

@section('title', $title ?? "")

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Scale</h1></div>
    <div class="p-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.index') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('ewp.dashboards.admin_dash') }}">Admin Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ "Scale" }}</li>
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
                <div class="ml-auto">
                    @include('widgets._searchForm')
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="thead-primary bg-navy text-center">
                        <tr>
                            @if(app()->currentLocale() == 'ms-my')
                                <th style="min-width:200px"> SKALA </th>
                            @elseif(app()->currentLocale() == 'en')
                                <th style="min-width:200px"> SCALE </th>
                            @endif
                        </tr>
                    </thead>
                </table>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead class="thead-navy bg-navy">
                        <tr>
                            <th style="width:5%" class="text-center"> # </th>
                            <th style="width:20%" class="text-center">
                                @foreach ($scales as $lookup => $item)
                                @endforeach
                                
                                @if(app()->currentLocale() == 'ms-my')
                                    Skala
                                @elseif(app()->currentLocale() == 'en')
                                    Scale
                                @endif
                            </th>
                            @foreach ($category as $key => $cat) 
                                <th class="text-center" style="width: 15%"> 
                                    {{ $cat->value_local }} 
                                    <br>
                                    <a class="{{ config("adminlte.btn_edit") }} btn showScale" 
                                        data-route="ewp/setup/scale" data-id="{{ $cat->id }}" data-title="Scales" 
                                        data-toggle="modal"><i class="fa fa-edit"></i>
                                    </a>
                                </th>
                            @endforeach
                            <th class="text-center" style="width: 15%"> Label </th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (count($scales) == 0)
                            <td style="text-align: center" colspan="8">No data availables</td>
                        @else
                            @foreach ($scales as $lookup => $item) 

                                    <tr>
                                        <td class="text-center">{{ ++$i }}</td>

                                        <td class="text-center">
                                            @if ($item['key'] == 'scales')
                                                @if(app()->currentLocale() == 'ms-my')
                                                    {{ $item['value_local'] }}
                                                @elseif(app()->currentLocale() == 'en')
                                                    {{ $item['value_translation'] }}
                                                @endif
                                            @endif
                                        </td>  

                                        {{-- @dd($category) --}}
                                        @foreach ($category as $key => $cat)

                                            @php    
                                                $meta = json_decode($cat['meta_value'], true);
                                            @endphp
                                            
                                            <td class="text-center" style="width: 15%"> 
                                                @if ($item['value_local'] == $meta[$lookup]['name'])
                                                    {{ $meta[$lookup]['min'] }} - {{ $meta[$lookup]['max'] }} 
                                                @endif
                                            </td>
                                            
                                        @endforeach

                                        <td class="text-center">
                                            @if ($item['value_local'] == 'TERUK' || $item['value_local'] == 'SANGAT TERUK')
                                                <div class="mx-4 font-weight-bold bg-warning text-white rounded">
                                                    INTERVENSI KHUSUS
                                                </div>

                                            @else 
                                                <div class="mx-4 font-weight-bold bg-info text-white rounded">
                                                    INTERVENSI UMUM
                                                </div>
                                                
                                            @endif
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
{!! $scales->setPath('')->render() !!}

@include('layouts.delete')
@include('layouts.modal')

@endsection

@section('js') 
    <script src="{{ asset('js/modal.js') }}"></script>
    <script src="{{ asset('js/select_modal.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>
@endsection