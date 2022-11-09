@php use Spatie\Permission\Models\Role; @endphp
@php use Illuminate\Support\Facades\Session; @endphp
@extends('layouts.app')
@section('title', 'Create new user')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header text-center">
                            <h1>Update user</h1>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('user.update', ['user'=>$user->id]) }}">
                                @csrf
                                @method('patch')
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                    </div>
                                    <input type="text"
                                           name="first_name"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           value="{{ $user->first_name ?? old('first_name') }}"
                                           placeholder="First name">

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                    </div>
                                    <input type="text"

                                           name="last_name"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           value="{{ $user->last_name ?? old('last_name') }}"
                                           placeholder="Last name">

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-envelope"></span></div>
                                    </div>
                                    <input type="email"
                                           name="email"
                                           value="{{ $user->email ?? old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Email"
                                           disabled>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-mobile-alt"></span>&nbsp;
                                        </div>
                                    </div>
                                    <input type="text"
                                           name="mobile"
                                           value="{{ $user->mobile ?? old('mobile') }}"
                                           class="form-control @error('mobile') is-invalid @enderror"
                                           placeholder="Mobile number">

                                    @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa--alt"></span>&nbsp;
                                        </div>
                                    </div>
                                    <input type="text"
                                           name="speciality"
                                           value="{{ $user->speciality ?? old('speciality') }}"
                                           class="form-control @error('speciality') is-invalid @enderror"
                                           placeholder="Speciality">

                                    @error('speciality')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-calendar-alt"></span></div>
                                    </div>
                                    <input type="date"
                                           name="date_of_birth"
                                           value="{{ date_format($user->date_of_birth, 'Y-m-d') ?? old('date_of_birth') }}"
                                           class="form-control @error('date_of_birth') is-invalid @enderror"
                                           placeholder="Date of birth">

                                    @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <label>User Role</label>
                                    <select name="role[]" class="select2"
                                            multiple="multiple"
                                            data-placeholder="select role"
                                            style="width: 100%;">
                                        @foreach(Role::all()->map->only(['name','id']) as $role)
                                            <option
                                                {{ in_array($role['name'],$user->roles->map->only('name')->flatten()->toArray()) ? 'selected' : '' }}
                                                value="{{ $role['id'] }}">{{ ucwords(str_replace('_', ' ', $role['name'])) }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
    </div>
    <!-- /.content -->

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
        @if(Session::has('message'))
        toastr.success('{{ Session::get('message') }}')
        @endif
    </script>
@endpush
