<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        $list = [
            [
                'name' => 'Người dùng',
                'link' => '/user',
                'icon' => 'fa fa-user-md',
            ],
            [
                'name' => 'Trường học',
                'link' => '/school',
                'icon' => 'fas fa-columns',
            ],
            [
                'name' => 'Học sinh',
                'link' => '/student',
                'icon' => 'fa fa-user-md',
            ],
            [
                'name' => 'Sách',
                'link' => '/book',
                'icon' => 'fa fa-book',
            ],
            [
                'name' => 'Thống kê mượn sách',
                'link' => '/studentBook',
                'icon' => 'fa fa-clipboard',
            ],
        ];

        foreach ($list as $item) {
            Role::insert([
                'name' => $item['name'],
                'link' => $item['link'],
                'is_child' => 1,
                'icon' => isset($item['icon']) ? $item['icon'] : '',
            ]);
        }
    }
}
