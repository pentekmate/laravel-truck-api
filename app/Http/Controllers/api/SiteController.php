<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        $sites = $user->sites()->with('trucks')->latest()->get();

        return SiteResource::collection($sites);
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
    public function store(Request $request,User $user)
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
        $validatedData['user_id']=$user->id;
     
        $site = Site::create($validatedData);
    
       
        if ($site) {
           
            return response()->json([
                'message' => 'Telephely sikeresen létrehozva!',
                'site' => $site,
            ], 201); 
        } else {
           
            return response()->json([
                'message' => 'Hiba történt a telephely létrehozása közben.',
            ], 500); 
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Site $site)
    {
        if ($user->sites()->where('id', $site->id)->exists()) {
            return new SiteResource($site);
        } else {
            return response()->json(['message' => 'A telephely nem található a megadott felhasználónál.'], 404);
        }
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
    public function update(Request $request,User $user, Site $site)
    {
        try{

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
            $validatedData['user_id']=$user->id;
    
            $site->update($validatedData);

            return response()->json([
                'message'=>'Telephely sikeresen frissítve'
            ]);
        }
        catch(ValidationException $e){
            return response()->json([
                'message'=>"Validációs hiba"
            ]);
        }

       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user,Site $site)
    {
        Site::destroy($site);

        return response()->json([
            'message'=>'Telephely sikeresen törölve!'
        ]);
    }
}
