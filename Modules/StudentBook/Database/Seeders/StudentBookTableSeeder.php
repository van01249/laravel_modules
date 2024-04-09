<?php

namespace Modules\StudentBook\Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\StudentBook\Entities\StudentBook;

class StudentBookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        StudentBook::truncate();
        for ($i = 0; $i <= 10; $i++) {
            StudentBook::insert([
                'id_book' => random_int(1, 10),
                'id_student' => random_int(1, 10),
                'is_back' => random_int(0, 1),
                'checkout_date' => new DateTime(),
                'return_date' => new DateTime(),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
        // $this->call("OthersTableSeeder");
    }
}
