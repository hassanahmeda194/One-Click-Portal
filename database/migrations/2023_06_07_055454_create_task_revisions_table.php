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
        Schema::create('task_revisions', function (Blueprint $table) {
            $table->id();
            $table->longText('Task_Revision');
            $table->bigInteger('task_id')->unsigned();
            $table->bigInteger('revised_by')->unsigned();
            $table->timestamps();
            $table->foreign('revised_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('task_revisions');
    }
};
