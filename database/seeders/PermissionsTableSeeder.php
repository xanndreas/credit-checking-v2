<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'credit_checking_access',
            ],
            [
                'id'    => 18,
                'title' => 'request_credit_create',
            ],
            [
                'id'    => 20,
                'title' => 'request_credit_show',
            ],
            [
                'id'    => 21,
                'title' => 'request_credit_delete',
            ],
            [
                'id'    => 22,
                'title' => 'request_credit_access',
            ],
            [
                'id'    => 28,
                'title' => 'request_credit_help_create',
            ],
            [
                'id'    => 29,
                'title' => 'request_credit_help_edit',
            ],
            [
                'id'    => 30,
                'title' => 'request_credit_help_show',
            ],
            [
                'id'    => 31,
                'title' => 'request_credit_help_delete',
            ],
            [
                'id'    => 32,
                'title' => 'request_credit_help_access',
            ],
            [
                'id'    => 55,
                'title' => 'survey_address_create',
            ],
            [
                'id'    => 56,
                'title' => 'survey_address_edit',
            ],
            [
                'id'    => 57,
                'title' => 'survey_address_show',
            ],
            [
                'id'    => 58,
                'title' => 'survey_address_delete',
            ],
            [
                'id'    => 59,
                'title' => 'survey_address_access',
            ],
            [
                'id'    => 60,
                'title' => 'survey_report_create',
            ],
            [
                'id'    => 61,
                'title' => 'survey_report_edit',
            ],
            [
                'id'    => 62,
                'title' => 'survey_report_show',
            ],
            [
                'id'    => 63,
                'title' => 'survey_report_delete',
            ],
            [
                'id'    => 64,
                'title' => 'survey_report_access',
            ],
            [
                'id'    => 75,
                'title' => 'profile_password_edit',
            ],
            [
                'id'    => 76,
                'title' => 'dashboard_access',
            ],
            [
                'id'    => 77,
                'title' => 'header_dashboard_access',
            ],
            [
                'id'    => 78,
                'title' => 'header_checking_access',
            ],
            [
                'id'    => 79,
                'title' => 'header_checking_survey_access',
            ],
            [
                'id'    => 80,
                'title' => 'header_utility',
            ],
            [
                'id'    => 81,
                'title' => 'setting_access',
            ],
            [
                'id'    => 82,
                'title' => 'setting_update',
            ],
            [
                'id'    => 83,
                'title' => 'actor_marketing_head_access',
            ],
            [
                'id'    => 84,
                'title' => 'actor_area_manager_access',
            ],
            [
                'id'    => 85,
                'title' => 'actor_branch_manager_access',
            ],
            [
                'id'    => 86,
                'title' => 'actor_auto_planner_access',
            ],
            [
                'id'    => 87,
                'title' => 'actor_surveyor_admin_access',
            ],
            [
                'id'    => 88,
                'title' => 'actor_surveyor_access',
            ],
            [
                'id'    => 89,
                'title' => 'request_credit_super',
            ],
            [
                'id'    => 90,
                'title' => 'approval_request_credit_approve',
            ],
            [
                'id'    => 91,
                'title' => 'request_credit_download',
            ],
            [
                'id'    => 92,
                'title' => 'survey_address_download',
            ],

        ];

        Permission::insert($permissions);
    }
}
