<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('labour_id');
            $table->string('food_rate_date');
            $table->decimal('attendence_number', 8, 2)->default(0);
            $table->integer('food_rate_will_get');
            $table->integer('food_rate_paid')->default(0);
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
        Schema::dropIfExists('salary_logs');
    }
}
