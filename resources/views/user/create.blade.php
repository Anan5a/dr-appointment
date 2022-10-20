@extends('layouts.app')
@section('title', 'Create new user')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card card-outline card-primary">
                        <div class="card-header text-center">
                            <h1>Create new user</h1>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('user.store') }}">
                                @csrf

                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-user"></span></div>
                                    </div>
                                    <input type="text"
                                           name="first_name"
                                           class="form-control @error('first_name') is-invalid @enderror"
                                           value="{{ old('first_name') }}"
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
                                           value="{{ old('last_name') }}"
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
                                           value="{{ old('email') }}"
                                           class="form-control @error('email') is-invalid @enderror"
                                           placeholder="Email">

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
                                           value="{{ old('mobile') }}"
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
                                        <div class="input-group-text"><span class="fas fa-calendar-alt"></span></div>
                                    </div>
                                    <input type="date"
                                           name="date_of_birth"
                                           value="{{ old('date_of_birth') }}"
                                           class="form-control @error('date_of_birth') is-invalid @enderror"
                                           placeholder="Date of birth">

                                    @error('date_of_birth')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>


                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                    </div>
                                    <input type="password"
                                           name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           placeholder="Password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                    @enderror
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><span class="fas fa-lock"></span></div>
                                    </div>
                                    <input type="password"
                                           name="password_confirmation"
                                           class="form-control"
                                           placeholder="Retype password">
                                </div>
                                <div class="input-group mb-3">
                                    <label>User Role</label>
                                    <select name="role[]" class="select2"
                                            multiple="multiple"
                                            data-placeholder="Any"
                                            style="width: 100%;"

                                    >
                                        @foreach(\Spatie\Permission\Models\Role::all()->map->only(['name','id']) as $role)
                                            <option
                                                value="{{ $role['id'] }}">{{ ucwords(str_replace('_', ' ', $role['name'])) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <!-- /.col -->
                                    <div class="col-4">
                                        <button type="submit" class="btn btn-primary btn-block">Create</button>
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
        @if(\Illuminate\Support\Facades\Session::has('message'))
            toastr.success('{{ \Illuminate\Support\Facades\Session::get('message') }}')
        @endif
    </script>
@endpush
