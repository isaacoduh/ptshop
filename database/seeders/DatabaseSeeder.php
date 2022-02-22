<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Model::unguard(); // tempoarary disble mass exception
        DB::beginTransaction();

        $this->call(AdminTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        DB::commit();
        Model::reguard();

    }
}
