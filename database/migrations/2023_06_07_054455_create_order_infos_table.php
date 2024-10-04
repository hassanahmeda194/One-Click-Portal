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
    public function up(): void
    {
        Schema::create('order_infos', static function (Blueprint $table) {
            $table->id();
            $table->string('Order_ID');
            $table->tinyInteger('Order_Type')->default(0);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('assign_id')->unsigned()->nullable();
            $table->bigInteger('client_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('order_client_infos')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('assign_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_infos');
    }
};
