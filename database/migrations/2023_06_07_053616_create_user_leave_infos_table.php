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
        Schema::create('user_leave_infos', static function (Blueprint $table) {
            $table->id();
            $table->integer('Sick_Leaves')->default(0);
            $table->integer('Annual_Leaves')->default(0);
            $table->integer('Casual_Leaves')->default(0);
            $table->integer('Un_Paid')->default(0);
            $table->string('Off_Day')->default('Sunday');
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_leave_infos');
    }
};
