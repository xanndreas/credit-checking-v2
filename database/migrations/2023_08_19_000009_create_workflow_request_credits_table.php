<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowRequestCreditsTable extends Migration
{
    public function up()
    {
        Schema::create('workflow_request_credits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('request_credit_batch');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
