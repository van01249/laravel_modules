<?php

namespace Modules\Book\Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Book\Entities\Book;
use Str;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Book::truncate();
        for ($i = 0; $i <= 10; $i++) {
            Book::insert([
                'title' => "Title " . Str::random(10),
                'author' => "Author " . Str::random(10),
                'genre' => "Genre " . Str::random(10),
                'publisher' => "Publisher " . Str::random(10),
                'publish_date' => new DateTime(),
                'quantity' => random_int(1, 1000),
                'quantity_lent' => random_int(0, 100),
                'available' => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);
        }
        // $this->call("OthersTableSeeder");
    }
}
