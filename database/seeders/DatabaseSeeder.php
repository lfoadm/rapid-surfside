<?php

namespace Database\Seeders;

use App\Models\Site\MonthName;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // User::factory(10)->create();
        
        User::factory()->create([
            'name' => 'Leandro Oliveira',
            'email' => 'lfoadm@icloud.com',
            'mobile' => '34999749344',
            'utype' => 'ADM',
        ]);
            
            $this->call([
                MonthSeeder::class
            ]);

    }
}
