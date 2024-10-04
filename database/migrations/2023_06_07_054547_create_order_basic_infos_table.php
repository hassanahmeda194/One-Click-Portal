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
        Schema::create('order_basic_infos', function (Blueprint $table) {
            $table->id();
            $table->string('Order_Services');
            $table->string('Education_Level');
            $table->double('Pages_Count')->default(0)->unsigned();
            $table->double('Word_Count')->default(0)->unsigned();
            $table->string('Spacing');
            $table->string('Citation_Style');
            $table->string('Sources')->nullable();
            $table->string('Order_Website');
            $table->tinyInteger('Order_Status')->default(0);
            $table->bigInteger('order_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('client_id')->unsigned();
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('order_client_infos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('order_basic_infos');
    }
};
