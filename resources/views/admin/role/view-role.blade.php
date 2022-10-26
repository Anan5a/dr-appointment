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
                </div>
                <div class="col-lg-9 col-6">

                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @component('components.table', [
                            'table_title'=>"Role info: <b>{$role->name}</b>",
                            "theads"=>["#","Permission", "State"]
                    ])
                        @slot('table_body')
                            @foreach($role->permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td class="project-actions text-right">allowed</td>
                                </tr>
                            @endforeach
                        @endslot
                    @endcomponent
                </div>
            </div>
        </div>
    </section>

@endsection
