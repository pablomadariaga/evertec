<?php

namespace Database\Seeders;

use App\Models\OrderState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = now();
        OrderState::insert([
            [
                'description' => 'CREATED',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'description' => 'PAYED',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'description' => 'REJECTED',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'description' => 'PENDING',
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }
}
