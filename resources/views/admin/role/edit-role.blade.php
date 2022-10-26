@php use Spatie\Permission\Models\Permission;use Spatie\Permission\Models\Role; @endphp
@php use Illuminate\Support\Facades\Request; @endphp
@extends('layouts.app')
@section('title', 'Editing Role')
@section('content')
    @include('includes.content-header', ['title'=>'Editing Role'])

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header text-center">
                            <h1>Update Role permissions</h1>
                            <p>Role: <b>{{ $role->name }}</b></p>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('admin.role.update', ['role'=>$role->id]) }}">
                                @csrf
                                @method('patch')
                                @component('components.table', [
                                    'table_title'=>'Permissions',
                                    "theads"=>["#","Name"]
                                ])
                                @slot('table_body')
                                        @foreach(Permission::all() as $permission)
                                            <tr>
                                                <td>
                                                    <input type="checkbox"
                                                           name="permission[]"
                                                           class="form-control"
                                                           @if($role->hasPermissionTo($permission)) checked @endif
                                                           value="{{ $permission->id }}">
                                                </td>
                                                <td>{{ $permission->name }}</td>
                                            </tr>
                                        @endforeach

                                    @endslot
                                @endcomponent

                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>
                        </div>
                        <!-- /.form-box -->
                    </div><!-- /.card -->
                </div>
            </div>
            <!-- /.form-box -->
        </div>
    </section>

@endsection
