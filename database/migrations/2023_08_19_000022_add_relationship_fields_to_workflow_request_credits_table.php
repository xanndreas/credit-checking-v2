<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkflowRequestCreditsTable extends Migration
{
    public function up()
    {
        Schema::table('workflow_request_credits', function (Blueprint $table) {
            $table->unsignedBigInteger('request_credit_id')->nullable();
            $table->foreign('request_credit_id', 'request_credit_fk_8894437')->references('id')->on('request_credits');
            $table->unsignedBigInteger('last_change_by_id')->nullable();
            $table->foreign('last_change_by_id', 'last_change_by_fk_8894438')->references('id')->on('users');
            $table->unsignedBigInteger('process_status_id')->nullable();
            $table->foreign('process_status_id', 'process_status_fk_8894439')->references('id')->on('workflow_processes');
        });
    }
}
