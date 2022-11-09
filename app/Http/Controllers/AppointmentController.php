<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $user = auth()->user();
        return view('appointment.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create(User $user)
    {
        return view('schedule.slots', [
            'user'=>$user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreAppointmentRequest $request)
    {
        Appointment::create([
            'schedule_id'=>$request->schedule_id,
            'user_id'=>auth()->user()->id,
        ]);
        return redirect()->route('home.index')->with('message', 'Your appointment was created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Appointment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appoinment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Appointment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function edit(Appointment $appoinment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentRequest  $request
     * @param  \App\Models\Appointment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentRequest $request, Appointment $appoinment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Appointment  $appoinment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appoinment)
    {
        //
    }
}
