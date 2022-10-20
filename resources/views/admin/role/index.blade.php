@php use Spatie\Permission\Models\Role; @endphp
@php use Illuminate\Support\Facades\Request; @endphp
@extends('layouts.app')
@section('title', 'Roles')
@section('content')
    @include('includes.content-header', ['title'=>'Roles'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- patients -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <!-- <a class="text-white" href="{{ route('admin.role.create') }}"> -->
                            <a class="text-white" href="#" onclick="return toastr.info('Feature not implemented yet')">
                                <h3><i class="fas fa-plus"></i></h3>
                                <p>Add new role</p>
                            </a>
                        </div>
                        <div class="icon">
                            <i class="fas fa-"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-6">

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @component('components.table', [
                            'table_title'=>'Roles',
                            'paginator'=>$roles,
                            "theads"=>["#","Role", "Action"]
                    ])
                        @slot('table_body')
                            @foreach($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="{{route('admin.role.show', ['role'=>$role->id])}}">
                                            <i class="fas fa-eye">
                                            </i>
                                            View
                                        </a>
                                        {{--
                                        <a class="btn btn-primary btn-sm" href="{{ route('admin.role.edit', ['user'=>$role->id]) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.role.destroy', ['role'=>$role->id]) }}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm delete-user" type="submit">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </button>
                                        </form>
                                        --}}

                                    </td>
                                </tr>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </section>

@endsection
