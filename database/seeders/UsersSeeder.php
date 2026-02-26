<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'fauzi admin',
                'role_as' => 'admin',
                'email' => 'fauziadmin@tracerstudy.com',
                'nomor_induk' => '18121',
                'password' => bcrypt('fauziadmin'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'fauzi admin 2',
                'role_as' => 'admin',
                'email' => 'fauziadmin2@tracerstudy.com',
                'nomor_induk' => '1812111',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ])->each(function ($user) {
            DB::table('users')->insert($user);
        });
    }
}
