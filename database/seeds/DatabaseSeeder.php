<?php

use App\User;
use Carbon\Carbon;
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
        $this->call(RoleSeeder::class);
        $this->call(UserRole::class);

        User::truncate();
        User::insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123123'),
            'is_admin' => true,
            'admin' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        User::insert([
            'name' => 'Admin Test',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('123123'),
            'is_admin' => true,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
