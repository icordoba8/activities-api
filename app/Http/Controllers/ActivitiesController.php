<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\TimeActivity;

class ActivitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     

        $activities = Activity::where('user_id', $request->user_id)->orderBy('updated_at','desc')->get();
        $newActivities = [];

        foreach ($activities as $key => $value) {
          $times = TimeActivity::where('activity_id','=',$value->id)->orderBy('updated_at','desc')->get();

          $value['hours'] = add_hours($times);
          $newActivities[$key] = $value;
        }

        return response()->json($newActivities, 201);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $response =[];
            $activity = Activity::Create([
                'name' => $request->name,
                'user_id' => $request->user_id
            ]);
            $activity->save();
            !$activity->id? $response['error'] = "error":
            $response['activity_id'] = $activity->id;
            $response['message'] = 'Actividad creada';
            return response()->json( $response, 201);

        } catch (\Throwable $th) {
            return response()->json([
                'error' =>  $th->errorInfo? $th->errorInfo: $th
            ], 201);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       return Activity::find($id);
    
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
        $activity = Activity::find($id);
        $activity->name = $request->name;
        $result = $activity->save();
        if($result!==true){
            return response()->json([
            'error' =>$result,'message' =>'Error actualizando actividad'], 201);
        }
        return response()->json([
            'message' =>'Actividad actualizada'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $activity = Activity::find($id);
        if(!$activity->id) return response()->json([
            'error' =>$result,'message' =>'Error Eliminando actividad'], 201);


        $result   = $activity->delete();
        if($result!==true){
            return response()->json([
            'error' =>$result,'message' =>'Error Eliminando actividad'], 201);
        }
        return response()->json([
            'message' =>'Actividad eliminada'
        ], 201);
       
    }
}
