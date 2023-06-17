@extends('adminlte::page')

@section('title', config('app.name') . ' - Access Control')

@section('content_header')
    <div class="d-flex">
        <div class="mr-auto p-2">
            <h1>Access Controls</h1>
        </div>
        <div class="p-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Access Controls</li>
                </ol>
            </nav>
        </div>
    </div>
@stop

@section('content')

    <div class="container-fluid">

        <div class="{{ config('adminlte.card_default') }}">
            <div class="card-header">
                <div class="d-flex">
                    <div class="mr-auto">
                        @can('user-create')
                            @include('widgets._addButton', ['route' => route('site.permissions.create'), 'label' => __('Add new permission')])
                        @endcan
                    </div>
                    <div class="">
                        @include('widgets._searchForm', ['route' => route('site.permissions.index'), 'placeholder' => __('Search vehicle...')])
                    </div>
                </div>    
            </div>
            <div class="card-body table-responsive">
                
                <table class="{{ config('adminlte.table_light') }}">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Permissions') }}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $i => $permission)
                            <tr data-widget="expandable-table" aria-expanded="{{ $i == 0 ? 'true':'true' }}">
                                <td><b>{{ Str::upper($permission->name) }}</b></td>
                                <td><span class="badge badge-dark badge-pill">{{ count($permission->children) }} {{ __('children') }}</span></td>
                                <td class="text-right text-muted text-sm font-italic">{{ __('Updated') }} {{ $permission->updated_at->diffForHumans() }}</td>
                            </tr>
                            @if (count($permission->children) > 0)
                                <tr class="expandable-body">
                                    <td colspan="3">
                                        <p class="p-0">
                                            <table class="table table-sm table-striped">
                                                @foreach ($permission->children as $item)  
                                                    <tr>
                                                        <td>{{ $item->name }} </td>
                                                        <td class="text-right text-muted text-sm font-italic">{{ __('Updated') }} {{ $item->updated_at->diffForHumans() }}</td>
                                                        <td class="text-right">
                                                            @can('role-delete')
                                                                @include('widgets._deleteButton', ['route' => route('site.permissions.destroy', $item)])
                                                            @endcan
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </p>
                                    </td>
                                </tr>
                            @endif
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </div>

@endsection

@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
        .parent~.cchild {
            display: none;
        }

        .open .parent~.cchild {
            display: table-row;
        }

        .parent {
            cursor: pointer;
        }

        tbody {
            color: #212121;
        }

        .open {
            background-color: #FFF;
        }

        .open .cchild {
            /* background-color: #CCC; */
            /* color: white; */
        }

        .parent>*:last-child {
            width: 30px;
        }

        .parent .collapse-icon {
            transform: rotate(0deg);
            transition: transform .3s cubic-bezier(.4, 0, .2, 1);
            margin: -.5rem;
            padding: .5rem;

        }

        .open .parent .collapse-icon {
            transform: rotate(180deg)
        }

    </style>
@endsection

@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $('table').on('click', 'tr.parent', function() {
            $(this).closest('tbody').toggleClass('open');
        });
    </script>
    <script>
        $(document).ready(function() {

            $('.toggle-class').change(function() {

                var status = $(this).prop('checked') == true ? 1 : 0;
                var id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: 'menus/changeStatus',
                    data: {
                        'status': status,
                        'id': id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(data) {

                        Swal.fire({
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            position: 'top-end',
                            toast: true,
                            title: data.message,
                            icon: data.status == true ? 'success' : 'warning',
                        });

                    }
                });
            });

            $('.sa-warning').click(function(e) {
                var pivotId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#remove').attr('action', "permissions/" + pivotId).submit();
                    }
                })
            });
        });
    </script>
@endsection