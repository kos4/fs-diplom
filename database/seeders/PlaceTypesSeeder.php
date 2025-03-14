<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaceTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('place_types')->insert([
            [
                'name' => 'Заблокированные (нет кресла)',
                'code' => 'disabled',
                'position' => 30,
            ],
            [
                'name' => 'Обычные кресла',
                'code' => 'standard',
                'position' => 10,
            ],
            [
                'name' => 'VIP кресла',
                'code' => 'vip',
                'position' => 20,
            ],
        ]);
    }
}
