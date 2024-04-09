<?php

namespace Modules\School\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\School\Entities\School;
use Str;

class SchoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        School::truncate();
        for ($i = 0; $i <= 10; $i++) {
            School::insert([
                'name' => "Trường đại học" . Str::random(),
                'address' => Str::random(10) . '- Hà Nội',
                'descriptions' => Str::random(100),
                'phone' => random_int(10000000000, 99999999999),
                'email' => Str::random(15) . '@gmail.com',
                'created_at' => new \DateTime,
                'updated_at' => new \DateTime,
            ]);
        }
        // $this->call("OthersTableSeeder");
    }
}
