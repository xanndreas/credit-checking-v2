<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveyAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('survey_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address_type');
            $table->longText('addresses')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
