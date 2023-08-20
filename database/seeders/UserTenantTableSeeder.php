<?php

namespace Database\Seeders;

use App\Models\UserTenant;
use Illuminate\Database\Seeder;

class UserTenantTableSeeder extends Seeder
{
    public function run()
    {
        $userTenant = [
            [
                'id'             => 1,
                'code'           => 'vqwsa',
                'parent_id'      => 2,
                'user_id'        => 3,
            ],
            [
                'id'             => 2,
                'code'           => 'ascsa',
                'parent_id'      => 2,
                'user_id'        => 4,
            ],
            // bm

            [
                'id'             => 3,
                'code'           => 'lklas',
                'parent_id'      => 3,
                'user_id'        => 5,
            ],
            [
                'id'             => 4,
                'code'           => 'kpass',
                'parent_id'      => 3,
                'user_id'        => 6,
            ],
            [
                'id'             => 5,
                'code'           => 'zxcqs',
                'parent_id'      => 4,
                'user_id'        => 7,
            ],
            // ap

            [
                'id'             => 6,
                'code'           => 'asd2q',
                'parent_id'      => 5,
                'user_id'        => 8,
            ],
            [
                'id'             => 7,
                'code'           => 'abwqw',
                'parent_id'      => 5,
                'user_id'        => 9,
            ],
            [
                'id'             => 8,
                'code'           => 'abvss',
                'parent_id'      => 6,
                'user_id'        => 10,
            ],
            [
                'id'             => 9,
                'code'           => 'hwaed',
                'parent_id'      => 6,
                'user_id'        => 11,
            ],
            [
                'id'             => 10,
                'code'           => 'dfhds',
                'parent_id'      => 7,
                'user_id'        => 12,
            ],
            [
                'id'             => 11,
                'code'           => 'acvas',
                'parent_id'      => 7,
                'user_id'        => 13,
            ],
        ];

        UserTenant::insert($userTenant);
    }
}
