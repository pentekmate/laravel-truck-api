<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\Truck;
use Illuminate\Database\Seeder;

class TruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $sites = Site::all();

        for ($i=0; $i <200 ; $i++) { 
           $site = $sites->random();
            Truck::factory()->create([
                'site_id'=>$site->id
            ]);

        }
    }
}
