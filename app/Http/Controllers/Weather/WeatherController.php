<?php

namespace App\Http\Controllers\Weather;
use App\Http\Controllers\Controller;

use RakibDevs\Weather\Weather;

use Illuminate\Http\Request;

class WeatherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCurrentByCity()
    {
        $wt = new Weather();

        $info = $wt->getCurrentByCity('kiribati'); 
        // dd($info);
        return view('weathers.kiribati.getCurrentByCity')->with('response', json_decode(json_encode($info), true));
        // json_decode( json_encode($data), true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get3HourlyByCity()
    {
        $wt = new Weather();

        $info = $wt->get3HourlyByCity('kiribati'); 
        // dd($info);
        return view('weathers.kiribati.get3HourlyByCity')->with('response', json_decode(json_encode($info), true));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxget3HourlyByCity()
    {
        $wt = new Weather();

        $info = $wt->get3HourlyByCity('kiribati'); 
        // dd($info);
        return view('weathers.kiribati.ajaxget3HourlyByCity');//->with('response', json_decode(json_encode($info), true));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
