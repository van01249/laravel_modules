<?php

namespace Modules\User\Database\Seeders;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserSeederTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Model::unguard();

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
