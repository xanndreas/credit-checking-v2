<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCreditHelpsTable extends Migration
{
    public function up()
    {
        Schema::create('request_credit_helps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('attribute')->nullable();
            $table->string('attribute_2')->nullable();
            $table->string('attribute_3')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
