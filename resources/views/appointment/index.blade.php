@extends('layouts.app')
@section('title', 'Appointments')
@section('content')
    @include('includes.content-header', ['title'=>'Appointments'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#timeline" data-toggle="tab">Timeline</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="timeline">
                                    <!-- The timeline -->
                                    @if(count($user->appointments) == 0)
                                        <b><span class="fas fa-info-circle"></span> Nothing here...</b>
                                    @endif
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        @php $scs = $user->schedules->reverse() @endphp
                                        @foreach($scs as $timeline)

                                            <div class="time-label">
                                                @if($timeline->from->isPast())
                                                    <span class="bg-success">{{ date_format($timeline->from, 'd M. Y') }}</span>
                                                @else
                                                    <span class="bg-danger">{{ date_format($timeline->from, 'd M. Y') }}</span>
                                                @endif
                                            </div>
                                            <div>
                                                <i class="fas fa-calendar-day bg-primary"></i>

                                                <div class="timeline-item">
                                                    <span class="time"><i class="far fa-clock"></i> {{ date_format($timeline->from, 'h:i A') }}</span>

                                                    <h3 class="timeline-header">Appointment</h3>

                                                    <div class="timeline-body">
                                                        Appointment with <b>{{ $timeline->appointment->user?->first_name }} {{ $timeline->appointment->user?->last_name }}</b>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
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
