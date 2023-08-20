<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowRequestCreditHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('workflow_request_credit_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('process_status');
            $table->string('process_notes')->nullable();
            $table->string('attribute')->nullable();
            $table->string('attribute_2')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
