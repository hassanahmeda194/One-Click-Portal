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
        Schema::create('order_task_submits', function (Blueprint $table) {
            $table->id();
            $table->string('File_Name')->nullable();
            $table->string('task_file_path')->nullable();
            $table->bigInteger('task_id')->unsigned();
            $table->bigInteger('submit_by')->unsigned();
            $table->timestamps();
            $table->foreign('submit_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('task_id')->references('id')->on('order_tasks')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_task_submits');
    }
};
