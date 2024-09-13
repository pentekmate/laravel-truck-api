<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TruckResource;
use App\Models\Site;
use App\Models\Truck;
use App\Models\User;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    //
    public function index(User $user,Site $site){
        if($site->user_id !==$user->id){
            return response()->json([
                'error'=>'Nincs ilyen telephely'
            ]);
        }

        $trucks = $site->trucks;

        return TruckResource::collection($trucks);
    }
    

    public function show(User $user,Site $site ,  int $truckId){

        
        $truck = $site->trucks()->findOrFail($truckId);


        return new TruckResource($truck);

    }

}
