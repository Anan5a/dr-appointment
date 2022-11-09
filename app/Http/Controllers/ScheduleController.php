<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShowScheduleRequest;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Schedule;
use App\Models\User;
use http\Env\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(ShowScheduleRequest $request)
    {
        return $this->show($request, auth()->user()->id);
    }

    /**
     * Display the specified resource.
     *
     * @param Schedule $schedule
     * @return Application|Factory|View
     */
    public function show(ShowScheduleRequest $request,$user)
    {
        $user = User::with('schedules')
            ->find(['id' => (int)$user])
            ->first();
        return view('schedule.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreScheduleRequest $request
     * @return RedirectResponse
     */
    public function store(StoreScheduleRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        Schedule::create($data);
        return redirect()->route('admin.home.index')->with('message', 'Schedule created');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Schedule $schedule
     * @return Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateScheduleRequest $request
     * @param Schedule $schedule
     * @return Response
     */
    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Schedule $schedule
     * @return Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }
}
