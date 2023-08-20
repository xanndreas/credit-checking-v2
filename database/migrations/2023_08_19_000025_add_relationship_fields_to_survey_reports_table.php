<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSurveyReportsTable extends Migration
{
    public function up()
    {
        Schema::table('survey_reports', function (Blueprint $table) {
            $table->unsignedBigInteger('request_credit_id')->nullable();
            $table->foreign('request_credit_id', 'request_credit_fk_8894487')->references('id')->on('request_credits');
            $table->unsignedBigInteger('survey_address_id')->nullable();
            $table->foreign('survey_address_id', 'survey_address_fk_8894473')->references('id')->on('survey_addresses');
            $table->unsignedBigInteger('submited_by_id')->nullable();
            $table->foreign('submited_by_id', 'submited_by_fk_8894474')->references('id')->on('users');
        });
    }
}
