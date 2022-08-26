<?php

namespace Database\Seeders;

use App\Models\Album;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // User::create([
        //     'id'                =>  1,
        //     'name'              =>  'Quasimoto',
        //     'email'             =>  'lordquas@mail.com',
        //     'email_verified_at' =>  now(),
        //     'password'          => Hash::make('123456'),
        //     'role'              => 'admin',
        //     'isBlocked'         => 0,
        // ]);

        // DB::table('roles')->insert([
        //     'id' => 1,
        //     'name' => 'admin'
        // ]);
        // DB::table('roles')->insert([
        //     'id' => 2,
        //     'name' => 'writer'
        // ]);
        // DB::table('roles')->insert([
        //     'id' => 3,
        //     'name' => 'user'
        // ]);
        // DB::table('role_user')->insert([
        //     'user_id'   =>  1,
        //     'role_id'   =>  1
        // ]);
        // DB::table('role_user')->insert([
        //     'user_id'   =>  1,
        //     'role_id'   =>  2
        // ]);
        // DB::table('role_user')->insert([
        //     'user_id'   =>  1,
        //     'role_id'   =>  3
        // ]);

        User::factory(8)->create();

        // Album::factory(4)->create([
        //     'user_id'   =>  1,
        // ]);
        
    }
}
