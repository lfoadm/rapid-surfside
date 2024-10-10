<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $months = [
            ['name' => 'Janeiro'],
            ['name' => 'Fevereiro'],
            ['name' => 'Março'],
            ['name' => 'Abril'],
            ['name' => 'Maio'],
            ['name' => 'Junho'],
            ['name' => 'Julho'],
            ['name' => 'Agosto'],
            ['name' => 'Setembro'],
            ['name' => 'Outubro'],
            ['name' => 'Novembro'],
            ['name' => 'Dezembro']
        ];

        DB::table('month_names')->insert($months);
    }
}
