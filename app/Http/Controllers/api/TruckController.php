<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TruckResource;
use App\Models\Site;
use App\Models\Truck;
use Illuminate\Http\Request;

class TruckController extends Controller
{
    //
    public function index(Site $site){
        $trucks = $site->trucks()->latest()->get();

        return TruckResource::collection($trucks);
    }
    

    public function show(Site $site ,  int $truckId){
        $truck = $site->trucks()->findOrFail($truckId);


        return new TruckResource($truck);

    }

}
