<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $types = array("credit_card", "cash_on_delivery", "bank_transfer");
        $bank_transfer = array(
            'swift' => 'WESTGBAV',
            'iban' => 'GB82 WEST 1234 5698 7654 32',
            'name' => 'Arthur King'
        );
        $credit_card = array(
            'holder_name' => 'Jon Smiggle',
            'number' => '4242 4242 4242 4242',
            'cvv' => 123,
            'expire_date' => '12/25'
        );
        $cash_on_delivery = array(
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'address' => '3, Ronald Way, Old Sea Port Road, LA'
        );

        $list = [
            [
                'id' => 1,
                'uuid' => Str::uuid(),
                'type' => "credit_card",
                'details' => json_encode($credit_card),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 2,
                'uuid' => Str::uuid(),
                'type' => "cash_on_delivery",
                'details' => json_encode($cash_on_delivery),
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => 3,
                'uuid' => Str::uuid(),
                'type' => "bank_transfer",
                'details' => json_encode($bank_transfer),
                'created_at' => $now,
                'updated_at' => $now
            ],
        ];

        foreach($list as $item) {
            DB::table('payments')->updateOrInsert(['id' => $item['id']], $item);
        }
    }
}
