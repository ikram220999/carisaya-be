<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChallengeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //

        if($request->userId){
            $challenge = Challenge::where('id_user', '!=', $request->userId)->get();
        } else {
            $challenge = Challenge::all();
        }

        $challenge->map(function ($chl) {
            $attachment = Attachment::where('id_challenge', $chl->id)->get();

            $chl->attachment = $attachment;
        });

        return response()->json($challenge, 200);
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
        // foreach ($request->allFiles() as $key => $file) {
        //     // Store the file in the storage directory or process it as needed
        //     // $file->store('your_custom_directory');
        //     dd($file);
        // }
        // dd($request->file('file'));
        $user =  Auth::user();
        $challenge = new Challenge();
        $challenge->latitude = $request->lat;
        $challenge->longitude = $request->lng;
        $challenge->id_user = $user->id;
        $challenge->save();

        if ($request->hasFile('file')) {
            foreach ($request->file('file') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();

                // Store the file in the storage directory
                $filePath = $file->storeAs('public/images', $fileName); // 'public/images' is the storage path, adjust as needed

                $fileUrl = Storage::url($filePath); // This assumes you are using the public disk
                // Optionally, you can also store the file path in the database or perform other actions
                $attachment = new Attachment();
                $attachment->id_challenge = $challenge->id;
                $attachment->name = $fileName;
                $attachment->location = $fileUrl;
                $attachment->type = 'evidence';
                $attachment->save();

                $uploadedFiles[] = $attachment;
            }
        }


        return response()->json(['challenge' => $challenge, 'attachment' => $uploadedFiles], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Challenge $challenge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Challenge $challenge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Challenge $challenge)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Challenge $challenge)
    {
        //
    }

}
