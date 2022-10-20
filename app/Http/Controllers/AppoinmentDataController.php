<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentDataRequest;
use App\Http\Requests\UpdateAppointmentDataRequest;
use App\Models\AppointmentData;

class AppoinmentDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAppointmentDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAppointmentDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AppointmentData  $appoinmentData
     * @return \Illuminate\Http\Response
     */
    public function show(AppointmentData $appoinmentData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AppointmentData  $appoinmentData
     * @return \Illuminate\Http\Response
     */
    public function edit(AppointmentData $appoinmentData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAppointmentDataRequest  $request
     * @param  \App\Models\AppointmentData  $appoinmentData
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAppointmentDataRequest $request, AppointmentData $appoinmentData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AppointmentData  $appoinmentData
     * @return \Illuminate\Http\Response
     */
    public function destroy(AppointmentData $appoinmentData)
    {
        //
    }
}
