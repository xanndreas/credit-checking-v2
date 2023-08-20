<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCreditsTable extends Migration
{
    public function up()
    {
        Schema::create('request_credits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('batch_number')->unique();
            $table->string('credit_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
