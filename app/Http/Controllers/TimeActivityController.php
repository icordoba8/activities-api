<?php

namespace App\Http\Controllers;

use App\Models\TimeActivity;
use Illuminate\Http\Request;

class TimeActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $timesActivity = TimeActivity::where('activity_id','=',$id)->orderBy('updated_at','desc')->get();
        $hours = TimeActivity::where('activity_id','=',$id)->get()->sum("hours");
        return response()->json([
            "times"=>$timesActivity,
            "hours"=>$hours
        ], 201);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         return TimeActivity::Create([
            'date_time' => $request->date_time,
            'hours' => $request->hours,
            'activity_id' => $request->activity_id
        ]);
        

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TimeActivity  $timeActivity
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $time = TimeActivity::find($id);
        $result   = $time->delete();
        if($result!==true){
            return response()->json([
            'error' =>$result,'message' =>'Error Eliminando tiempo'], 201);
        }
        return response()->json([
            'message' =>'Tiempo eliminado'
        ], 201);
    }
}
