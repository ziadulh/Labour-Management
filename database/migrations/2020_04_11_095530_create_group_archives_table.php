<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupArchivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_archives', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('labour_id');
            $table->bigInteger('group_id');
            $table->bigInteger('building_id');
            $table->decimal('attendence_number',8,2);
            $table->bigInteger('food_rate_will_get');
            $table->bigInteger('food_rate_paid');
            $table->date('food_rate_date');
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
        Schema::dropIfExists('group_archives');
    }
}
