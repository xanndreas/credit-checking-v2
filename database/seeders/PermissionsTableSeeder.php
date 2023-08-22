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
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
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
                'id'    => 19,
                'title' => 'request_credit_edit',
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
                'id'    => 23,
                'title' => 'request_credit_debtor_create',
            ],
            [
                'id'    => 24,
                'title' => 'request_credit_debtor_edit',
            ],
            [
                'id'    => 25,
                'title' => 'request_credit_debtor_show',
            ],
            [
                'id'    => 26,
                'title' => 'request_credit_debtor_delete',
            ],
            [
                'id'    => 27,
                'title' => 'request_credit_debtor_access',
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
                'id'    => 33,
                'title' => 'workflow_access',
            ],
            [
                'id'    => 34,
                'title' => 'workflow_process_create',
            ],
            [
                'id'    => 35,
                'title' => 'workflow_process_edit',
            ],
            [
                'id'    => 36,
                'title' => 'workflow_process_show',
            ],
            [
                'id'    => 37,
                'title' => 'workflow_process_delete',
            ],
            [
                'id'    => 38,
                'title' => 'workflow_process_access',
            ],
            [
                'id'    => 39,
                'title' => 'workflow_request_credit_create',
            ],
            [
                'id'    => 40,
                'title' => 'workflow_request_credit_edit',
            ],
            [
                'id'    => 41,
                'title' => 'workflow_request_credit_show',
            ],
            [
                'id'    => 42,
                'title' => 'workflow_request_credit_delete',
            ],
            [
                'id'    => 43,
                'title' => 'workflow_request_credit_access',
            ],
            [
                'id'    => 44,
                'title' => 'workflow_request_credit_history_create',
            ],
            [
                'id'    => 45,
                'title' => 'workflow_request_credit_history_edit',
            ],
            [
                'id'    => 46,
                'title' => 'workflow_request_credit_history_show',
            ],
            [
                'id'    => 47,
                'title' => 'workflow_request_credit_history_delete',
            ],
            [
                'id'    => 48,
                'title' => 'workflow_request_credit_history_access',
            ],
            [
                'id'    => 49,
                'title' => 'credit_checking_survey_access',
            ],
            [
                'id'    => 50,
                'title' => 'request_approval_create',
            ],
            [
                'id'    => 51,
                'title' => 'request_approval_edit',
            ],
            [
                'id'    => 52,
                'title' => 'request_approval_show',
            ],
            [
                'id'    => 53,
                'title' => 'request_approval_delete',
            ],
            [
                'id'    => 54,
                'title' => 'request_approval_access',
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
                'id'    => 65,
                'title' => 'survey_report_attribute_create',
            ],
            [
                'id'    => 66,
                'title' => 'survey_report_attribute_edit',
            ],
            [
                'id'    => 67,
                'title' => 'survey_report_attribute_show',
            ],
            [
                'id'    => 68,
                'title' => 'survey_report_attribute_delete',
            ],
            [
                'id'    => 69,
                'title' => 'survey_report_attribute_access',
            ],
            [
                'id'    => 70,
                'title' => 'request_credit_attribute_create',
            ],
            [
                'id'    => 71,
                'title' => 'request_credit_attribute_edit',
            ],
            [
                'id'    => 72,
                'title' => 'request_credit_attribute_show',
            ],
            [
                'id'    => 73,
                'title' => 'request_credit_attribute_delete',
            ],
            [
                'id'    => 74,
                'title' => 'request_credit_attribute_access',
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
                'id'    => 89,
                'title' => 'approval_request_credit_approve',
            ],

        ];

        Permission::insert($permissions);
    }
}
