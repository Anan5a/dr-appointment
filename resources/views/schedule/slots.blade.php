@php use Spatie\Permission\Models\Role; @endphp
@php use Illuminate\Support\Facades\Request; @endphp
@extends('layouts.app')
@section('title', 'Slots')
@section('content')
    @include('includes.content-header', ['title'=>'Available slots'])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            </div>
            <div class="row">
                <div class="col-12">
                    @component('components.table', [
                            'table_title'=>'Slots',
//                            'paginator'=>$user,
                            "theads"=>["From", "To", "Status", "Action"]
                    ])
                        @slot('table_body')
                            @foreach($user->schedules as $schedule)
                                <tr>
                                    <td>{{ date_format($schedule->from, 'd M, Y H:i:s A') }}</td>
                                    <td>{{ date_format($schedule->to, 'd M, Y H:i:s A') }}</td>
                                    <td>{{ !$schedule->appointment ? 'Open' : 'Booked' }}</td>

                                    <td class="project-actions text-right">
                                        @if(!$schedule->appointment)
                                            <form action="{{ route('appointment.store') }}" method="post">

                                                @csrf
                                                <input type="hidden" value="{{ $schedule->id }}" name="schedule_id">
                                                <button class="btn btn-info btn-sm" type="submit">
                                                    Book
                                                </button>
                                            </form>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endslot
                    @endcomponent
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
