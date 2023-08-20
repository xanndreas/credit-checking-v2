<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserTenantsTable extends Migration
{
    public function up()
    {
        Schema::table('user_tenants', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id', 'parent_fk_8123018')->references('id')->on('users');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8541220')->references('id')->on('users');
        });
    }
}
