<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSurveyAddressesTable extends Migration
{
    public function up()
    {
        Schema::table('survey_addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('request_credit_id')->nullable();
            $table->foreign('request_credit_id', 'request_credit_fk_8894465')->references('id')->on('request_credits');
            $table->unsignedBigInteger('surveyor_id')->nullable();
            $table->foreign('surveyor_id', 'surveyor_fk_8894468')->references('id')->on('users');
        });
    }
}
