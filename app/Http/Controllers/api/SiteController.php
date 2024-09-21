<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiteResource;
use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SiteController extends Controller implements HasMiddleware
{
    use AuthorizesRequests;

    public static function middleware():array{
        return[
            new Middleware('auth:sanctum')
        ];
    }
    //working
    public function index($userid){
       try{
            $userLoggedIn = Auth::user();
            $user = User::findOrFail($userid);
            if($userLoggedIn->id !== $user->id){
                return response()->json([
                    'message'=>'Ez a site nem hozzád tartozik.'
                ],403);
            }
            
               
            $sites = $user->sites()->with('trucks', 'monthlySummaries')->get();
            return new SiteResource($sites);
             
       }
       catch (ModelNotFoundException $e) {
        return response()->json([
            'message' => 'Nem található a keresett user.',
            'error' => $e->getMessage()
        ], 404);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => 'Valami hiba történt.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store($userid,Request $request,){
     
        $result = Auth::user()->id===intval($userid);
        if(!$result){
            return response()->json([
                'message'=>'Ez a funkció nem hozzád tartozik.'
            ],403);
        }
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
        $validatedData['user_id']=$userid;
        

        Site::create($validatedData);

        return response()->json([
            'message'=>'Sikeres létrehozás!'
        ]);
        
    }

   //working
    public function show(User $user,$siteid){
       try{
            $site = Site::findOrFail($siteid);
            if (Gate::denies('view', $site)) {
                return response()->json(['message' => 'This action is unauthorized.'], 403);
            }
            $site->load('trucks', 'monthlySummaries');

            if(!$site){
                return 'rossz';
            }
            return new SiteResource($site);
       }
       catch (ModelNotFoundException $e) {
        // Ha a rekord nem található
        return response()->json([
            'message' => 'Nem található a keresett site.',
            'error' => $e->getMessage()
        ], 404);
        }
        catch (\Exception $e) {
            return response()->json([
                'message' => 'Valami hiba történt.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

    //working
    public function update(Request $request,User $user, Site $site){
        if (Gate::denies('update', $site)) {
            return response()->json(['message' => 'This action is unauthorized.'], 403);
        }
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

    //working
    public function destroy(User $user,$siteId)
    {
        try{
            $site = Site::findOrFail($siteId);
            if (Gate::denies('delete', $site)) {
                return response()->json(['message' => 'This action is unauthorized.'], 403);
            }

            Site::destroy($siteId);
    
            return response()->json([
                'message'=>'Telephely sikeresen törölve!'
            ]);
        }
        catch (ModelNotFoundException $e) {
            return response()->json([
                'message' => 'Nem található a keresett site.',
                'error' => $e->getMessage()
            ], 404);
            }
            catch (\Exception $e) {
                return response()->json([
                    'message' => 'Valami hiba történt.',
                    'error' => $e->getMessage()
                ], 500);
            }

    }
}
