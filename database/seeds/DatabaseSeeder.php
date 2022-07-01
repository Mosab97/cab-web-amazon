<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(FoodTrackSeeder::class);
//        // $this->call(UsersTableSeeder::class);
//
//        App\Models\User::create([
//            'fullname' => "Tester",
//            'phone' => "987321654",
//            'email' => "test@info.com",
//            'is_active' => 1,
//            'is_ban' => 0,
//            'email_verified_at' =>now()->addDay(rand(1,6)),
//            'password' => '123456789', // secret
//            'user_type' => 'superadmin', // secret
//            'gender' => 'male', // secret
//            'remember_token' => Str::random(10),
//        ]);
//        // App\Models\User::create([
//        //     'fullname' => "Admin",
//        //     'phone' => "123456789",
//        //     'email' => "admin@info.com",
//        //     'is_active' => 1,
//        //     'is_ban' => 0,
//        //     'email_verified_at' =>now()->addDay(rand(1,6)),
//        //     'password' => '123456789', // secret
//        //     'user_type' => 'superadmin', // secret
//        //     'gender' => 'male', // secret
//        //     'remember_token' => Str::random(10),
//        // ]);
//
//        // App\Models\User::create([
//        //     'fullname' => "Developer",
//        //     'phone' => "254874411222",
//        //     'email' => "developer@info.com",
//        //     'is_active' => 1,
//        //     'is_ban' => 0,
//        //     'email_verified_at' =>now()->addDay(rand(1,6)),
//        //     'password' => '123456789', // secret
//        //     'user_type' => 'superadmin', // secret
//        //     'gender' => 'male', // secret
//        //     'remember_token' => Str::random(10),
//        // ]);
    }
}
