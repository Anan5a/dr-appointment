@extends('layouts.app')
@section('title', 'Profile')
@section('content')
    @include('includes.content-header', ['title'=>'Profile'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ asset($user->profile_picture) }}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->first_name }} {{ $user->last_name }}</h3>

                            <p class="text-muted text-center">{{ ucwords(join(', ', (array) $user->roles->map->only('name')->flatten()->toArray()), ", ") }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
{{--                                <li class="list-group-item">--}}

{{--                                    <b>Patients</b> <a class="float-right">1,322</a>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item">--}}
{{--                                    <b>Appointments</b> <a class="float-right">543</a>--}}
{{--                                </li>--}}
{{--                                <li class="list-group-item">--}}
{{--                                    <b>Active Schedules</b> <a class="float-right">13,287</a>--}}
{{--                                </li>--}}
                                @if( auth()->user()->hasAnyRole(['super admin', 'doctor']) || $user->id == auth()->id() )
                                <li class="list-group-item">
                                    <b>Mobile number</b> <a class="float-right">+88 {{ $user->mobile }}</a>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
{{--                    <div class="card card-primary">--}}
{{--                        <div class="card-header">--}}
{{--                            <h3 class="card-title">About</h3>--}}
{{--                        </div>--}}
{{--                        <!-- /.card-header -->--}}
{{--                        <div class="card-body">--}}
{{--                            <strong><i class="fas fa-book mr-1"></i> Education</strong>--}}

{{--                            <p class="text-muted">--}}
{{--                                B.S. in Computer Science from the University of Tennessee at Knoxville--}}
{{--                            </p>--}}

{{--                            <hr>--}}

{{--                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>--}}

{{--                            <p class="text-muted">Malibu, California</p>--}}

{{--                            <hr>--}}

{{--                            <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>--}}

{{--                            <p class="text-muted">--}}
{{--                                <span class="tag tag-danger">UI Design</span>--}}
{{--                                <span class="tag tag-success">Coding</span>--}}
{{--                                <span class="tag tag-info">Javascript</span>--}}
{{--                                <span class="tag tag-warning">PHP</span>--}}
{{--                                <span class="tag tag-primary">Node.js</span>--}}
{{--                            </p>--}}

{{--                            <hr>--}}

{{--                            <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>--}}

{{--                            <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam--}}
{{--                                fermentum enim neque.</p>--}}
{{--                        </div>--}}
{{--                        <!-- /.card-body -->--}}
{{--                    </div>--}}
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
{{--                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a>--}}
{{--                                </li>--}}
                                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a>
                                </li>
                                @if(auth()->id() == $user->id)
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                                @endif
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
{{--                                <div class="active tab-pane" id="activity">--}}
{{--                                    <!-- Post -->--}}
{{--                                    <b class="text-gray"><span class="fas fa-info"></span> Your activity will appear here</b>--}}
{{--                                </div>--}}
                                <!-- /.tab-pane -->
                                <div class="active tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    @if(count($user->appointments) == 0)
                                        <b><span class="fas fa-info-circle"></span> Nothing here...</b>
                                    @endif
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        @php $aps = $user->appointments->reverse() @endphp
                                        @foreach($aps as $timeline)
                                            <div class="time-label">
                                                @if($timeline->schedule->from->isPast())
                                                    <span class="bg-success">{{ date_format($timeline->schedule->from, 'd M. Y') }}</span>
                                                @else
                                                    <span class="bg-danger">{{ date_format($timeline->schedule->from, 'd M. Y') }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <i class="fas fa-calendar-day bg-primary"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> {{ date_format($timeline->schedule->from, 'h:i A') }}</span>

                                                    <h3 class="timeline-header">Appointment</h3>

                                                    <div class="timeline-body">
                                                        Appointment with <b>{{ $timeline->schedule->user?->first_name }} {{ $timeline->schedule->user?->last_name }}</b>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                @if(auth()->id() == $user->id)
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal" method="post" action="{{ route('user.update', ['user'=>$user->id]) }}">
                                        @method('put')
                                        @csrf
                                        <div class="form-group row">
                                            <label for="IDfirst_name" class="col-sm-2 col-form-label">First Name</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                       name="first_name"
                                                       id="IDfirst_name"
                                                       class="form-control @error('first_name') is-invalid @enderror"
                                                       value="{{ $user->first_name ?? old('first_name') }}"
                                                       placeholder="First name">

                                                @error('first_name')
                                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="IDlast_name" class="col-sm-2 col-form-label">Last Name</label>
                                            <input type="text"
                                                   id="IDlast_name"
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
                                        <div class="form-group row">
                                            <label for="IDmobile" class="col-sm-2 col-form-label">Mobile</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                       name="mobile"
                                                       id="IDmobile"
                                                       value="{{ $user->mobile ?? old('mobile') }}"
                                                       class="form-control @error('mobile') is-invalid @enderror"
                                                       placeholder="Mobile number">

                                                @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @hasanyrole('super admin|doctor|manager')
                                        <div class="form-group row">
                                            <label for="IDSpc" class="col-sm-2 col-form-label">Speciality</label>
                                            <div class="col-sm-10">
                                                <input type="text"
                                                       name="speciality"
                                                       id="IDSpc"
                                                       value="{{ $user->speciality ?? old('speciality') }}"
                                                       class="form-control @error('speciality') is-invalid @enderror"
                                                       placeholder="Speciality">

                                                @error('mobile')
                                                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @endhasanyrole
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endif
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
