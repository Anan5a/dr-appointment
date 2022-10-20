@php use \Spatie\Permission\Models\Role; @endphp
@extends('layouts.app')
@section('content')
    @include('includes.content-header', ['title'=>'Dashboard'])
    <!-- main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- overview -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- patients -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $userCount }}</h3>
                            <p>Patients</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <a href="{{ route('user.index', ['result_type[]'=>Role::findByName('patient')->id]) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- doctors -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $doctorCount }}</h3>

                            <p>Doctors</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <a href="{{ route('user.index', ['result_type[]'=>Role::findByName('doctor')->id]) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $managerCount }}</h3>

                            <p>Managers</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-cog"></i>
                        </div>
                        <a href="{{ route('user.index', ['result_type[]'=>Role::findByName('manager')->id]) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $adminCount }}</h3>

                            <p>Admins</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <a href="{{ route('user.index', ['result_type[]'=>Role::findByName('super admin')->id]) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection
