<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToWorkflowRequestCreditHistoriesTable extends Migration
{
    public function up()
    {
        Schema::table('workflow_request_credit_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('workflow_request_credit_id')->nullable();
            $table->foreign('workflow_request_credit_id', 'workflow_request_credit_fk_8894445')->references('id')->on('workflow_request_credits');
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->foreign('actor_id', 'actor_fk_8894446')->references('id')->on('users');
        });
    }
}
