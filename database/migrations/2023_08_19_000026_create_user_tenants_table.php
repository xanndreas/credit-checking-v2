<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTenantsTable extends Migration
{
    public function up()
    {
        Schema::create('user_tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
