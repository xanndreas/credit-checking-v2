<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRequestCreditsTable extends Migration
{
    public function up()
    {
        Schema::table('request_credits', function (Blueprint $table) {
            $table->unsignedBigInteger('auto_planner_id')->nullable();
            $table->foreign('auto_planner_id', 'auto_planner_fk_8894380')->references('id')->on('users');
        });
    }
}
