<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyReportAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('survey_report_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('object_name');
            $table->string('attribute')->nullable();
            $table->string('attribute_2')->nullable();
            $table->string('attribute_3')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
