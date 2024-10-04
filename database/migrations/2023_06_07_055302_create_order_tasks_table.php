<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_tasks', function (Blueprint $table) {
            $table->id();
            $table->double('Assign_Words')->unsigned();
            $table->double('Total_Words')->unsigned();
            $table->double('Due_Words')->unsigned();
            $table->date('DeadLine');
            $table->time('DeadLine_Time');
            $table->tinyInteger('Task_Status')->default(0);
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('assign_id')->unsigned();
            $table->bigInteger('assign_by')->unsigned();
            $table->timestamps();
            $table->foreign('assign_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('assign_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_id')->references('id')->on('order_infos')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_tasks');
    }
};
