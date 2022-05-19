@extends('adminlte::page')

@section('title', config('app.name') . ' - Users')

@section('content_header')
<div class="d-flex">
    <div class="mr-auto p-2"><h1>Users</h1></div>
    <div class="p-2">
        
    </div>
</div>
@stop

@section('content')
<div class="container-fluid">
    
    <div class="{{ config('adminlte.card_default') }}">
        
        <div class="card-body">
            <div class="d-flex">
                <div class="mr-auto">
                    @can('user-create')
                        @include('widgets._addButton', ['route' => route('site.users.create'), 'label' => __('Add new user')])
                        <div style="display: none;" id="div-delete-all">
                            <div class="mt-2 mb-2">
                                <button type="button" class="{{ config('adminlte.btn_delete') }}" id="btn-delete-all">Delete</button>
                            </div>
                        </div>
                    @endcan
                </div>
                <div class="">
                    @include('widgets._searchForm', ['route' => route('site.users.index'), 'placeholder' => __('Search vehicle...')])
                </div>
            </div>    
            <div class="table-responsive">
                <table class="{{ config('adminlte.table_light') }}">
                    <thead>
                        <tr>
                            <th style="width: 30px;"><input type="checkbox" id="select-all" class="checkbox" /></th>
                            <th style="width: 50px;">{{ __("No") }}</th>
                            <th style="width:80px;"></th>
                            <th>{{ __("Name") }}</th>
                            <th>{{ __("Contact") }}</th>
                            <th>{{ __('Roles') }}</th>
                            <th style="min-width: 200px;" width="200px"></th>
                            <th style="min-width: 160px;" width="160px"></th>
                        </tr>
                    </thead>
                
                    @foreach ($users as $key => $user)
                    <tr>
                        <td>
                            @if ($user->id != auth()->user()->id)
                            <div>
                                {{ Form::checkbox('user[]', $user->id, null, ['id' => 'checkbox', 'class' => 'checkbox']) }}
                            </div>    
                            @endif
                        </td>
                        <td>{{ ++$i }}</td>
                        <td>
                            @include('widgets._staffPhoto', ['id' => $user->profile->salary_no, 'width' => '60'])
                        </td>
                        <td>
                            <div class="font-weight-bold">
                                <a href="{{ route('site.users.show', $user) }}">{{ $user->name }}</a>
                            </div>
                            @if(isset($user->profile->ptj))
                                <small class="text-muted">{{ $user->profile->ptj->name ?? '' }}</small>
                            @endif
                            @if(isset($user->profile->department))
                                <br><small class="text-muted font-weight-bold">{{ $user->profile->department->name ?? '' }}</small>
                            @endif
                        </td>
                        <td>
                            <div class="text-muted text-sm">
                                <i class="fa fa-envelope"></i> {{ $user->email }} <br>
                                <i class="fa fa-phone"></i> {{ $user->profile->office_no }}
                            </div>
                        </td>
                        <td>
                            @if(!empty($user->getRoleNames()))
                                <ul class="list-unstyled">
                                    @foreach($user->getRoleNames() as $v)
                                        <li><label class="badge badge-pill badge-dark">{{ $v }}</label></li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            <div class="text-muted text-sm">
                                {{ __('Updated') }} {{ $user->created_at->diffForHumans() }}
                            </div>
                        </td>
                        <td style="text-align: right;">
                            
                            @if (auth()->user()->id == $user->id)
                            <span class="text-sm text-muted">{{ __("It's you") }}</span>
                            @endif
                            @can('user-impersonate')
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('site.users.logged-as.login',$user->id) }}" data-toggle="tooltip" data-placement="top" title="{{ __('Impersonate') }}">
                                <i class="fa fa-user-secret"></i>
                            </a>
                            @endcan
                            @can('user-edit')
                                
                                @include('widgets._editButton', ['route' => route('site.users.edit',$user->id)])
                            @endcan
                            @if(auth()->user()->id != $user->id)
                                @can('user-delete')
                                    @include('widgets._deleteButton', ['route' => route('site.users.destroy', $user)])
                                @endcan                                
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    

                </table>
            </div>

            @if (count($users) == 0)
                <div class="text-center">

                    <i class="fa fa-search fa-4x text-muted"></i>
                    <div class="text-bold">
                        {{ __('Could not find any items') }}
                    </div>
                    <div class="text-muted">
                        {{ __('Try changing the filters or add a new one') }}
                    </div>
    
                    <div class="mt-3">
                        @can('users-create', Model::class)
                        <a class="{{ config('adminlte.btn_add', 'btn-flat btn-primary') }}" href="{{ route('site.users.create') }}"><i class="fa fa-plus"></i> Add User</a>    
                        @endcan
                    </div>
    
                </div>
            @endif
            
            {!! $users->appends(Request::except('page'))->render() !!}
            
        </div>

    </div>
</div>
@endsection

@push('js')
    
    <script>
        $(document).ready(function() {
            $('.checkbox').on('click', function() {
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
                if (checkedOne == true) {
                    $('#div-delete-all').show();
                }
                else {
                    $('#div-delete-all').hide();
                }
            });

            $('#btn-delete-all').on('click', function() {
                var id = [];
                $('input[type="checkbox"]:checked').each(function(){
                    id.push($(this).val());
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: '{!! route('site.users.batch-destroy') !!}',
                    data: {'id': id, _token: "{{csrf_token()}}"},
                    success: function(data){
                        
                        Swal.fire({
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                            position: 'top-end',
                            toast: true, 
                            title: data.message,
                            icon: data.status == true? 'success':'warning',
                        });

                        location.reload();
                        
                    }
                }); // end ajax
            });
        });
    </script>

@endpush