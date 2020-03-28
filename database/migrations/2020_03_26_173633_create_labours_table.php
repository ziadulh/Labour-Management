<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labours', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('joining_date');
            $table->bigInteger('labour_type');
            $table->bigInteger('group_id');
            $table->bigInteger('building_id');
            $table->integer('attendance_rate');
            $table->integer('food_rate');
            $table->bigInteger('total_food_rate')->default(0);
            $table->bigInteger('due_foodrate')->default(0);
            $table->decimal('total_attendance', 8, 2)->default(0);
            $table->bigInteger('total_salary')->default(0);
            $table->bigInteger('total_paid')->default(0);
            $table->bigInteger('total_due')->default(0);
            $table->tinyInteger('status');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('labours');
    }
}
