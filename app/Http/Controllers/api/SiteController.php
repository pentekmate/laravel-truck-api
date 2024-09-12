<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        return SiteResource::collection(Site::with('trucks')
        ->latest()->paginate());
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
        
        $validatedData = $request->validate([
            'address' => 'required|max:100|string',
            'name' => 'required|max:100|string',
            'phone_number' => 'required|max:100|string',
            'email' => 'required|max:100|string',
            'open_time' => 'required|date_format:H:i:s',
            'close_time' => 'required|date_format:H:i:s',
            'capacity' => 'required|integer',
            'manager_name' => 'required|max:100|string',
        ]);
    
     
        $site = Site::create($validatedData);
    
       
        if ($site) {
           
            return response()->json([
                'message' => 'Telephely sikeresen létrehozva!',
                'site' => $site,
            ], 201); // 201 - Létrehozott státuszkód
        } else {
           
            return response()->json([
                'message' => 'Hiba történt a telephely létrehozása közben.',
            ], 500); // 500 - Szerver hiba
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Site $site)
    {
        return new SiteResource($site);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Site $site)
    {
        $site->update(
        $validatedData = $request->validate([
            'address' => 'required|max:100|string',
            'name' => 'required|max:100|string',
            'phone_number' => 'required|max:100|string',
            'email' => 'required|max:100|string',
            'open_time' => 'required|date_format:H:i:s',
            'close_time' => 'required|date_format:H:i:s',
            'capacity' => 'required|integer',
            'manager_name' => 'required|max:100|string',
        ])
    );

        return new SiteResource($site);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        Site::destroy($site);

        return response()->json([
            'message'=>'Telephely sikeresen törölve!'
        ]);
    }
}
