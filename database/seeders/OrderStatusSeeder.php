<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();

        $list = [
            [
                'id' => 1,
                'uuid' => Str::uuid(),
                'title' => 'Pending'
            ],
            [
                'id' => 2,
                'uuid' => Str::uuid(),
                'title' => 'Successful'
            ],
            [
                'id' => 3,
                'uuid' => Str::uuid(),
                'title' => 'Cancelled'
            ],
        ];

        foreach($list as $item) {
            DB::table('order_statuses')->updateOrInsert(['id' => $item['id']], $item);
        }
    }
}
