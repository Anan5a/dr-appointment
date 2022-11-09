@php use Spatie\Permission\Models\Role; @endphp
@php use Illuminate\Support\Facades\Request; @endphp
@extends('layouts.app')
@section('title', 'Home page')
@section('content')
    @include('includes.content-header', ['title'=>'Search Doctors'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- patients -->
                </div>
                <div class="col-lg-9 col-6">
                    <form action="{{ route("page.search") }}">
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
                                                @foreach(Role::all()->map->only(['name','id']) as $role)
                                                    @if($role['name'] != 'doctor')
                                                        @continue
                                                    @endif
                                                    <option selected
                                                        value="{{ $role['id'] }}">{{ ucwords(str_replace('_', ' ', $role['name'])) }}</option>
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

        $(".delete-user").on('click', function (ev) {
            ev.preventDefault();
            let form = $(this).closest('form')
            Swal.fire({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true,
                dangerMode: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit()
                }
            })
        })

        @if(Session::has('message'))
        toastr.success('{{ Session::get('message') }}')
        @endif
    </script>

@endpush
