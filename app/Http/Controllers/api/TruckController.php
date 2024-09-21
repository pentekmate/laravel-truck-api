<?php

namespace App\Http\Controllers\api;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Controllers\Controller;
use App\Http\Resources\TruckResource;
use App\Models\Site;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class TruckController extends Controller implements HasMiddleware
{
    //
    public static function middleware():array
    {
        return[
            new Middleware('auth:sanctum')
        ];
    }
    public function index(User $user,Site $site){
        
        if(Gate::denies('viewAny')){
            return response()->json([
                'message'=>'Ez a cég nem hozzád tartozik.'
            ],403);
        }
        $trucks = $site->trucks;

        return TruckResource::collection($trucks);
    }
    

    public function show(User $user,Site $site ,  int $truckId){

        
        $truck = $site->trucks()->findOrFail($truckId);


        return new TruckResource($truck);

    }

}
