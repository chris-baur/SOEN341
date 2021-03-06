<?php

namespace App\Http\Controllers;

use App\Http\Traits\ScheduleTraits;
use Illuminate\Http\Request;
use Auth;
use App\Schedule;

class ScheduleController extends Controller
{

  use ScheduleTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $schedule = Schedule::where( 'user_id', Auth::id() )->oldest()->first();
      if( !isset($schedule) ) {
        return redirect('schedule/create');
      }
      return view( 'schedule.index' , compact('schedule') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $schedule = Schedule::where('user_id', Auth::id())->oldest()->first();
        if(isset($schedule)) {
          return redirect('schedule');
        }
        return view( 'schedule.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->schedule_store($request);
        return redirect('schedule');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
      $schedule = Schedule::where( 'user_id', Auth::id() )->oldest()->first();
      if( !isset($schedule) ) {
        return redirect('schedule/create');
      }
      return view( 'schedule.edit' , compact('schedule') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $schedule = schedule::where('user_id', Auth::id())->oldest()->first();
      $schedule->freetime = $this->to_freetime($request);
      $schedule->save();
      return redirect('schedule');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
