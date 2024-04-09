<?php

use App\Models\UserRole;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserRole::truncate();
        for ($i = 1; $i < 5; $i++) {
            UserRole::insert([
                'user_id' => '2',
                'role_id' => $i,
                'add' => random_int(0, 1),
                'edit' => random_int(0, 1),
                'delete' => random_int(0, 1),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
