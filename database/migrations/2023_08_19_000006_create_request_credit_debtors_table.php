<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestCreditDebtorsTable extends Migration
{
    public function up()
    {
        Schema::create('request_credit_debtors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('personel_type');
            $table->string('name')->nullable();
            $table->string('identity_type')->nullable();
            $table->string('identity_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
