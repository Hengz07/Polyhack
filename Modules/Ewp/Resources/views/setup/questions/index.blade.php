@extends('adminlte::page')

@section('title', config('app.name') . ' - ')

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Questions</h1></div>
    <div class="p-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Questions</li>
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
                    @can('role-create')
                        @include('widgets._addButton', ['route' => route('ewp.setup.questions.create'), 'label' => __('Add new')])
                    @endcan
                </div>
                <div class="">
                    @include('widgets._searchForm', ['route' => route('ewp.setup.questions')])
                </div>
            </div>

                <div class="table-responsive">
                    <table class="{{ config('adminlte.table_light') }}" id="roles-table" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th>{{ __('Sections') }}</th>
                                <th>{{ __('Descritions') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Versions') }}</th>
                                <th style="width: 20%;"></th>
                                <th style="min-width: 180px; width: 180px;" class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>
                                    {{ $question->ewp_sections_code }}
                                </td>
                                <td><b>{{ $question->ewp_desc_bm }}</b> <div class="text-sm text-muted">{{ $question->ewp_desc_bm }}</div></td>
                                <td>
                                    {{ $question->ewp_status }}
                                </td>
                                <td>
                                    {{ $question->ewp_versions }}
                                </td>
                            
                                <td>
                                    <div class="text-muted text-sm">{{ __("Updated on") }} </div>
                                </td>
                                <td class="text-right">
                                    
                                    @can('role-edit')
                                        @include('widgets._editButton', ['route' => route('site.roles.edit', $question)])
                                    @endcan
                                    
                                    @can('role-delete')
                                        @include('widgets._deleteButton', ['route' => route('site.roles.destroy', $question)])
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
    </div>

</div>

@endsection

@push('js')
    <script>
        $('.myTable').dataTable();
    </script>
@endpush