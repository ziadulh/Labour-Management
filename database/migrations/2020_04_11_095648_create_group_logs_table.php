<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_logs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('group_id');
            $table->date('payment_date');
            $table->text('description');
            $table->bigInteger('total_amount');
            $table->bigInteger('total_paid');
            $table->bigInteger('total_due');
            $table->bigInteger('last_paid');
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
        Schema::dropIfExists('group_logs');
    }
}
