<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDoctorQualificationRequest;
use App\Http\Requests\UpdateDoctorQualificationRequest;
use App\Models\DoctorQualification;

class DoctorQualificationController extends Controller
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
     * @param  \App\Http\Requests\StoreDoctorQualificationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorQualificationRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DoctorQualification  $doctorQualification
     * @return \Illuminate\Http\Response
     */
    public function show(DoctorQualification $doctorQualification)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DoctorQualification  $doctorQualification
     * @return \Illuminate\Http\Response
     */
    public function edit(DoctorQualification $doctorQualification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDoctorQualificationRequest  $request
     * @param  \App\Models\DoctorQualification  $doctorQualification
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorQualificationRequest $request, DoctorQualification $doctorQualification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DoctorQualification  $doctorQualification
     * @return \Illuminate\Http\Response
     */
    public function destroy(DoctorQualification $doctorQualification)
    {
        //
    }
}
