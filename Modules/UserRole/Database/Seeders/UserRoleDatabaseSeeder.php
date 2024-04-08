<?php

namespace Modules\UserRole\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\UserRole\Entities\Models\UserRole;

class UserRoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserRoleTableSeeder::class);
    }
}
