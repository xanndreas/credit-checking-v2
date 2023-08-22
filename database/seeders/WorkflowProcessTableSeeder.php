<?php

namespace Database\Seeders;

use App\Models\WorkflowProcess;
use Illuminate\Database\Seeder;

class WorkflowProcessTableSeeder extends Seeder
{
    public function run()
    {
        $workflowProcess = [
            [
                'id'             => 1,
                'process_status' => 'request_credit',
                'permissions'    => 'actor_auto_planner_access',
                'description'    => '',
            ],            [
                'id'             => 2,
                'process_status' => 'request_approval',
                'permissions'    => 'actor_surveyor_admin_access',
                'description'    => '',
            ],            [
                'id'             => 3,
                'process_status' => 'request_surveys',
                'permissions'    => 'actor_auto_planner_access',
                'description'    => '',
            ],            [
                'id'             => 4,
                'process_status' => 'survey_assign',
                'permissions'    => 'actor_surveyor_admin_access',
                'description'    => '',
            ],            [
                'id'             => 5,
                'process_status' => 'survey_process',
                'permissions'    => 'actor_surveyor_access',
                'description'    => '',
            ],            [
                'id'             => 6,
                'process_status' => 'survey_report',
                'permissions'    => 'actor_surveyor_access',
                'description'    => '',
            ],
        ];

        WorkflowProcess::insert($workflowProcess);
    }
}



