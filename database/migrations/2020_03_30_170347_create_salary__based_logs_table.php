<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryBasedLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary__based_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id');
            $table->integer('salary');
            $table->string('month');
            $table->integer('group_id');
            $table->bigInteger('building_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salary__based_logs');
    }
}
