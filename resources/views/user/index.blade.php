@php use Spatie\Permission\Models\Role; @endphp
@php use Illuminate\Support\Facades\Request; @endphp
@extends('layouts.app')
@section('title', 'Users')
@section('content')
    @include('includes.content-header', ['title'=>'Users'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- patients -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <a class="text-white" href="{{ route('user.create') }}">
                                <h3><i class="fas fa-plus"></i></h3>
                                <p>Add new user</p>
                            </a>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-6">
                    <form action="{{ route("user.index") }}">
                        <div class="row">
                            <div class="col-md-10 offset-md-1">
                                <div class="row">
                                    <div class="col-6">
                                        @component('components.select2-options',[
                                            'label'=>'Result Type:',
                                            'name'=>'result_type[]',
                                            'multiple'=>true,

                                        ])
                                            @slot('options')
                                                <option
                                                    {{ in_array('all', Request::query('result_type', [])) ? 'selected' : '' }}
                                                    value="all">All
                                                </option>
                                                @foreach(Role::all()->map->only(['name','id']) as $role)
                                                    <option
                                                        {{ in_array($role['id'],Request::query('result_type', [])) ? 'selected' : '' }}
                                                        value="{{ $role['id'] }}">{{ ucwords(str_replace('_', ' ', $role['name'])) }}</option>
                                                @endforeach
                                            @endslot
                                        @endcomponent
                                    </div>
                                    <div class="col-3">

                                        @component('components.select2-options', [
                                            'label'=>'Sort Order:',
                                            'name'=>'sort_order'
                                        ])
                                            @slot('options')
                                                @foreach(['asc','desc'] as $so)
                                                    <option
                                                        {{ Request::query('sort_order') == $so ? 'selected' : '' }} value="{{$so}}">{{ strtoupper($so) }}</option>
                                                @endforeach
                                            @endslot
                                        @endcomponent
                                    </div>
                                    <div class="col-3">

                                        @component('components.select2-options', [
                                            'label'=>'Order By:',
                                            'name'=>'order_by'
                                        ])
                                            @slot('options')
                                                @foreach(['id','first_name','last_name'] as $ob)
                                                    <option
                                                        value="{{ $ob }}">{{ ucwords(str_replace('_', ' ',$ob)) }}</option>
                                                @endforeach
                                            @endslot
                                        @endcomponent
                                    </div>
                                </div>
                                @component('components.searchbar-long',[
                                        'name'=>'query',
                                        'placeholder'=>"Email, Phone or Name",
                                        'value'=>Request::query('query'),
])
                                @endcomponent
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @component('components.table', [
                            'table_title'=>'Users',
                            'paginator'=>$users,
                            "theads"=>["#","Picture", "Name", "Email", "Phone", "Type","Registration date", "Action"]
                    ])
                        @slot('table_body')
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td><img async class="img img-circle" height="32" width="32"
                                             src="{{asset($user->profile_picture)}}" alt=""></td>
                                    <td>{{$user->first_name}} {{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->mobile }}</td>
                                    <td><b>{{ join(', ', $user->roles->map->only('name')->flatten()->toArray()) }}</b></td>
                                    <td>{{ date_format($user->created_at, 'd M, Y') }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{route('user.show', ['user'=>$user->id])}}">
                                            <i class="fas fa-eye">
                                            </i>
                                            View
                                        </a>
                                        <a class="btn btn-primary btn-sm" href="{{ route('user.edit', ['user'=>$user->id]) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <form action="{{ route('user.destroy', ['user'=>$user->id]) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm delete-user" type="submit">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        @endslot
                        @slot('filter_selection')
                            <div class="col-lg-9 col-6">
                                <form action="{{ route("user.index") }}" method="get" id="tableDataSelectionForm">
                                    <div class="row">
                                        <div class="col-md-10 offset-md-1">
                                            <div class="row">
                                                <div class="col-6">
                                                    @component('components.select2-options',[
                                            'name'=>'result_type[]',
                                            'multiple'=>true,
                                            'form_id'=>'tableDataSelectionForm'
                                        ])
                                                        @slot('options')
                                                            <option
                                                                {{ in_array('all', Request::query('result_type', [])) ? 'selected' : '' }}
                                                                value="all">All
                                                            </option>
                                                            @foreach(Role::all()->map->only(['name','id']) as $role)
                                                                <option
                                                                    {{ in_array($role['id'],Request::query('result_type', [])) ? 'selected' : '' }}
                                                                    value="{{ $role['id'] }}">{{ ucwords(str_replace('_', ' ', $role['name'])) }}</option>
                                                            @endforeach
                                                        @endslot
                                                    @endcomponent
                                                </div>
                                                <div class="col-3">
                                                    @component('components.select2-options', [
                                            'name'=>'sort_order',
                                            'form_id'=>'tableDataSelectionForm'
                                        ])
                                                        @slot('options')
                                                            @foreach(['asc','desc'] as $so)
                                                                <option
                                                                    {{ Request::query('sort_order') == $so ? 'selected' : '' }} value="{{$so}}">{{ strtoupper($so) }}</option>
                                                            @endforeach
                                                        @endslot
                                                    @endcomponent

                                                </div>
                                                <div class="col-3">
                                                    @component('components.select2-options', [
                                            'name'=>'order_by',
                                            'form_id'=>'tableDataSelectionForm'
                                        ])
                                                        @slot('options')
                                                            @foreach(['id','first_name','last_name'] as $ob)
                                                                <option
                                                                    value="{{ $ob }}">{{ ucwords(str_replace('_', ' ',$ob)) }}</option>
                                                            @endforeach
                                                        @endslot
                                                    @endcomponent
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </section>

@endsection
@push('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endpush

@push('third_party_scripts')
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
@endpush
@push('page_scripts')
    <script>
        $(function () {
            $('.select2').select2()
        });

        $(".delete-user").on('click', function (ev){
            ev.preventDefault();
            let form = $(this).closest('form')
            Swal.fire({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton:true,
                confirmButtonColor: "#d33",
                cancelButtonColor:"#3085d6",
                confirmButtonText: "Yes, delete",
                cancelButtonText: "No",
                closeOnConfirm:false,
                closeOnCancel:true,
                dangerMode:true
            }).then( (result)=>{
                if( result.isConfirmed){
                    form.submit()
                }
            })
        })

        @if(Session::has('message'))
            toastr.success('{{ Session::get('message') }}')
        @endif
    </script>

@endpush
