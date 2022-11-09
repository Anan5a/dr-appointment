@extends('layouts.app')
@section('title', 'Results')
@section('content')
    <section class="content">
        <div class="container-fluid">
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
                                        @foreach(\Spatie\Permission\Models\Role::all()->map->only(['name','id']) as $role)
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
                        <div class="form-group">
                            <div class="input-group input-group-lg">
                                <input type="search" class="form-control form-control-lg" placeholder="Query" value="{{ \Illuminate\Support\Facades\Request::query('query') }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-lg btn-default">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt-3">
                <div class="col-md-10 offset-md-1">
                    <div class="list-group">
                        @foreach($users as $user)
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <img class="img-fluid" src="{{ asset($user->profile_picture) }}" alt="Photo" style="max-height: 160px;">
                                    </div>
                                    <div class="col px-4">
                                        <div>
                                            {{--                                        <div class="float-right">2021-04-20 04:04pm</div>--}}
                                            <h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
                                            <p class="mb-0">Specialty: {{ $user->specialty }}</p>
                                        </div>
                                        <div>
                                            <a href="{{ route('appointment.create.v1', ['user'=>$user->id]) }}">
                                                <button class="btn btn-info">Get appointment</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
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
