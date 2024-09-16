<?php

namespace Database\Seeders;

use App\Models\Site;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Site::factory(30)->create();
        $users = User::all();
        for ($i=0; $i <200 ; $i++) { 
            $user= $users->random();
            Site::factory()->create([
                'user_id'=>$user->id
            ]);
        }

        $this->call(TruckSeeder::class);
        $this->call(MonthlySummarySeeder::class);

    }
}
