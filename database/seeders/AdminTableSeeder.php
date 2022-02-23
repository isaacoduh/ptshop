<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $adminList = [
            [
                'id' => 1,
                'first_name' => 'admin',
                'last_name' => 'domain',
                'email' => 'admin@buckhill.co.uk',
                'password' => bcrypt('admin'),
                'uuid' => Str::uuid(),
                'is_admin' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        foreach($adminList as $admin) {
            DB::table('users')->updateOrInsert(['id' => $admin['id']], $admin);
        }
    }
}
