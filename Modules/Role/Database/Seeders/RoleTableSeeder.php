<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Role\Entities\Models\Role;

class RoleTableSeeder extends Seeder
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
                'id_parent' => 0,
                'show' => 1,
                'link' => '',
                'icon' => 'fa fa-user-md',
                'is_child' => 1,
            ],
            [
                'name' => 'Danh sách người dùng',
                'id_parent' => 1,
                'show' => 1,
                'link' => '/user',
                'is_child' => 0,
            ],
            [
                'name' => 'Thêm mới người dùng',
                'id_parent' => 1,
                'show' => 1,
                'link' => '/user/create',
                'is_child' => 0,
            ],
            [
                'name' => 'Chỉnh sửa người dùng',
                'id_parent' => 1,
                'show' => 0,
                'link' => '',
                'is_child' => 0,
            ],
            [
                'name' => 'Xóa người dùng',
                'id_parent' => 1,
                'show' => 0,
                'link' => '',
                'is_child' => 0,
            ],
            [
                'name' => 'Trường học',
                'id_parent' => 0,
                'show' => 1,
                'link' => '',
                'icon' => 'fas fa-columns',
                'is_child' => 1,
            ],
            [
                'name' => 'Danh sách trường học',
                'id_parent' => 6,
                'show' => 1,
                'link' => '/school',
                'is_child' => 0,
            ],
            [
                'name' => 'Thêm mới trường học',
                'id_parent' => 6,
                'show' => 1,
                'link' => '/school/create',
                'is_child' => 0,
            ],
            [
                'name' => 'Chỉnh sửa trường học',
                'id_parent' => 6,
                'show' => 0,
                'link' => '',
                'is_child' => 0,
            ],
            [
                'name' => 'Xóa trường học',
                'id_parent' => 6,
                'show' => 0,
                'link' => '',
                'is_child' => 0,
            ],
            [
                'name' => 'Học sinh',
                'id_parent' => 0,
                'show' => 1,
                'link' => '',
                'icon' => 'fa fa-user-md',
                'is_child' => 1,
            ],
            [
                'name' => 'Danh sách học sinh',
                'id_parent' => 11,
                'show' => 1,
                'link' => '/student',
                'is_child' => 0,
            ],
            [
                'name' => 'Thêm mới học sinh',
                'id_parent' => 11,
                'show' => 1,
                'link' => '/student/create',
                'is_child' => 0,
            ],
            [
                'name' => 'Chỉnh sửa học sinh',
                'id_parent' => 11,
                'show' => 0,
                'link' => '',
                'is_child' => 0,
            ],
            [
                'name' => 'Xóa học sinh',
                'id_parent' => 11,
                'show' => 0,
                'link' => '',
                'is_child' => 0,
            ],
            [
                'name' => 'Sách',
                'id_parent' => 0,
                'show' => 1,
                'link' => '',
                'icon' => 'fa fa-book',
                'is_child' => 1,
            ],
            [
                'name' => 'Danh sách',
                'id_parent' => 16,
                'show' => 1,
                'link' => '/book',
                'is_child' => 0,
            ],
            [
                'name' => 'Thêm mới sách',
                'id_parent' => 16,
                'show' => 1,
                'link' => '/book/create',
                'is_child' => 0,
            ],
            [
                'name' => 'Chỉnh sửa sách',
                'id_parent' => 16,
                'show' => 0,
                'link' => '',
                'is_child' => 0,
            ],
            [
                'name' => 'Xóa sách',
                'id_parent' => 16,
                'show' => 0,
                'link' => '',
                'is_child' => 0,
            ],
            [
                'name' => 'Thống kê mượn sách',
                'id_parent' => 0,
                'show' => 1,
                'link' => '',
                'icon' => 'fa fa-clipboard',
                'is_child' => 1,
            ],
            [
                'name' => 'Danh sách mượn sách',
                'id_parent' => 21,
                'show' => 1,
                'link' => '/studentBook',
                'is_child' => 0,
            ],
            [
                'name' => 'Thêm mới mượn sách',
                'id_parent' => 21,
                'show' => 1,
                'link' => '/studentBook/create',
                'is_child' => 0,
            ],
            [
                'name' => 'Chỉnh sửa mượn sách',
                'id_parent' => 21,
                'show' => 0,
                'link' => '',
                'is_child' => 0,
            ],
            [
                'name' => 'Xóa mượn sách',
                'id_parent' => 21,
                'show' => 0,
                'link' => '',
                'is_child' => 0,
            ],
        ];

        foreach ($list as $item) {
            Role::insert([
                'name' => $item['name'],
                'show' => $item['show'],
                'link' => $item['link'],
                'icon' => isset($item['icon']) ? $item['icon'] : '',
                'is_child' => $item['is_child'],
                'id_parent' => $item['id_parent']
            ]);
        }
    }
}
