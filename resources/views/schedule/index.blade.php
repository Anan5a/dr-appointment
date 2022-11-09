@extends('layouts.app')
@section('content')
    @include('includes.content-header', ['title'=>"Schedules of <b>$user->first_name $user->last_name </b>"])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="sticky-top mb-3">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Create Schedule</h3>
                            </div>
                            <div class="card-body">
                                <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                                    <ul class="fc-color-picker" id="color-chooser">
                                        <li><a class="text-primary" href="#" data-value="3B71CA"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-warning" href="#" data-value="E4A11B"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-success" href="#" data-value="14A44D"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-danger" href="#" data-value="DC4C64"><i class="fas fa-square"></i></a></li>
                                        <li><a class="text-muted" href="#" data-value="9FA6B2"><i class="fas fa-square"></i></a></li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
                                <div class="input-group">
                                    <form action="{{ route('schedule.store') }}" method="post">
                                        @csrf
                                        <input id="title" type="text" class="form-control"
                                               placeholder="Title" name="title" required min="5" max="10">
                                        <input id="color" type="hidden" name="color" value="f56954">
                                        <input type="datetime-local" name="from" class="form-control">
                                        <input type="datetime-local" name="to" class="form-control">
                                        <div class="input-group-append">
                                            <button id="add-new-event" type="submit" class="btn btn-primary">Save
                                            </button>
                                        </div>
                                    </form>
                                    <!-- /btn-group -->
                                </div>
                                <!-- /input-group -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card card-primary">
                        <div class="card-body p-0">
                            <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
@push('third_party_stylesheets')
    <!-- fullCalendar -->
    <link rel="stylesheet" href="{{ asset('plugins/fullcalendar/main.css') }}">

@endpush
@push('third_party_scripts')
    <!-- fullCalendar 2.2.5 -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/fullcalendar/main.js') }}"></script>
@endpush
@push('page_scripts')
    <script>
        $(function () {

            /* initialize the external events
             -----------------------------------------------------------------*/
            function ini_events(ele) {
                ele.each(function () {

                    // create an Event Object (https://fullcalendar.io/docs/event-object)
                    // it doesn't need to have a start or end
                    var eventObject = {
                        title: $.trim($(this).text()) // use the element's text as the event title
                    }

                    // store the Event Object in the DOM element so we can get to it later
                    $(this).data('eventObject', eventObject)

                    // make the event draggable using jQuery UI
                    $(this).draggable({
                        zIndex: 1070,
                        revert: true, // will cause the event to go back to its
                        revertDuration: 0  //  original position after the drag
                    })

                })
            }

            //ini_events($('#external-events div.external-event'))

            /* initialize the calendar
             -----------------------------------------------------------------*/
            //Date for the calendar events (dummy data)
            var Calendar = FullCalendar.Calendar;
            var calendarEl = document.getElementById('calendar');
            var calendar = new Calendar(calendarEl, {
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                themeSystem: 'bootstrap',
                //Random default events
                events: [
                        @foreach($user->schedules as $schedule)
                    {
                        title: '{{  $schedule->title }}',
                        start: new Date("{{ $schedule->from }}"),
                        end: new Date("{{ $schedule->to }}"),
                        backgroundColor: '#{{ $schedule->color ?? 'f56954'}}', //red
                        borderColor: '#{{ $schedule->color ?? 'f56954' }}', //red
                    },
                    @endforeach
                ],
            });
            calendar.render();
            var currColor = '#3c8dbc' //Red by default
            // Color chooser button
            $('#color-chooser > li > a').click(function (e) {
                e.preventDefault()
                // Save color
                currColor = $(this).attr('data-value')
                // Add color effect to button
                $('#color').attr('value', currColor)
            })

        })
    </script>
@endpush
