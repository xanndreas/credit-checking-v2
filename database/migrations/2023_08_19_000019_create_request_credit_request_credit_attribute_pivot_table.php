<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCreditRequestCreditAttributePivotTable extends Migration
{
    public function up()
    {
        Schema::create('request_credit_request_credit_attribute', function (Blueprint $table) {
            $table->unsignedBigInteger('request_credit_id');
            $table->foreign('request_credit_id', 'request_credit_id_fk_8894505')->references('id')->on('request_credits')->onDelete('cascade');
            $table->unsignedBigInteger('request_credit_attribute_id');
            $table->foreign('request_credit_attribute_id', 'request_credit_attribute_id_fk_8894505')->references('id')->on('request_credit_attributes')->onDelete('cascade');
        });
    }
}
