<?php

namespace App\Http\Controllers;

use App\Models\Guess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $user = Auth::user();

        if($user){
            $guess = new Guess();
            $guess->id_challenge = $request->idChallenge;
            $guess->id_user = $user->id;
            $guess->point = $request->point;
            $guess->latitude = $request->lat;
            $guess->longitude = $request->lng;
            $guess->save();

            return response()->json($guess, 200);
        }else {
            return response()->json(null, 400);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Guess $guess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guess $guess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guess $guess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guess $guess)
    {
        //
    }
}
