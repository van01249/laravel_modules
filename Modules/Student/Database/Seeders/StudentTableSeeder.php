<?php

namespace Modules\Student\Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Student\Entities\Student;
use Str;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Student::truncate();
        for ($i = 0; $i <= 10; $i++) {
            Student::insert([
                'id_school' => random_int(1, 10),
                'name' => "Name " . Str::random(10),
                'birthday' => new DateTime(),
                'gender' => random_int(1, 3),
                'grade_level' => random_int(1, 12),
                'address' => Str::random(10) . '- Hà Nội',
                'parent_guardian_name' => "Name " . Str::random(25),
                'phone' => random_int(10000000000, 99999999999),
                'email' => Str::random(15) . '@gmail.com',
                'id_card' => random_int(100000000000, 999999999999),
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
    }
}
