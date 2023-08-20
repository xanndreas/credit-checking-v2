<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyReportSurveyReportAttributePivotTable extends Migration
{
    public function up()
    {
        Schema::create('survey_report_survey_report_attribute', function (Blueprint $table) {
            $table->unsignedBigInteger('survey_report_id');
            $table->foreign('survey_report_id', 'survey_report_id_fk_8894486')->references('id')->on('survey_reports')->onDelete('cascade');
            $table->unsignedBigInteger('survey_report_attribute_id');
            $table->foreign('survey_report_attribute_id', 'survey_report_attribute_id_fk_8894486')->references('id')->on('survey_report_attributes')->onDelete('cascade');
        });
    }
}
