<?php

namespace Database\Seeders;

use App\Models\MonthlySummary;
use App\Models\Site;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonthlySummarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        $sitesWithTrucks = Site::with('trucks')->get();

        for ($i=0; $i <300 ; $i++) { 
            $site = $sitesWithTrucks->random();
            $siteTrucksLength=$site->trucks->count();
            MonthlySummary::factory()->create([
                'site_id'=>$site->id,
                'income'=>$siteTrucksLength ===0 ? 0 :rand(0,300000),
                'all_routes_length'=>$siteTrucksLength ===0 ?0 :rand(0,300000)
            ]);
        }
    }
}
