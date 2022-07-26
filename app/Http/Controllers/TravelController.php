<?php

namespace App\Http\Controllers;

use App\Models\Travel;
use App\Models\Trakin;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travel = Travel::all();
        return response()->json($travel); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $travel = Travel::create($request->post());
        return response()->json([
            'travel' => $travel
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function show(Travel $travel)
    {
        return response()->json($travel);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Travel $travel)
    {
        $trav = $travel->fill($request->post())->save();
        return response()->json([
            'travel' => $trav
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Travel  $travel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Travel $travel)
    {
        $travel->delete();
        return response()->json([
            'message' => 'DELETED SUCCESSFULLY'
        ]);
    }

    /**
     * Display a listing of the travel by code.
     *
     * @return \Illuminate\Http\Response
     */
    public function findByCode(Request $request)
    {
        $travel = Travel::where('code',$request->code)->with('trakins')->get();
        return response()->json($travel); 
    }

    /**
     * Display a listing of the travel by code.
     *
     * @return \Illuminate\Http\Response
     */
    public function findLastTrakinByCode(Request $request)
    {
        $travel = Travel::where('code',$request->code)->get()->first();
        
            $trackin = Trakin::where('travel_id',$travel->id)
            ->orderBy('id','desc')
            ->get()
            ->first();
    
        return response()->json($trackin); 
    }
}
