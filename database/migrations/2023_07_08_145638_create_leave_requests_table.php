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
        Schema::create('leave_requests', static function (Blueprint $table) {
            $table->id();
            $table->string('Leave_Subject');
            $table->date('F_Date');
            $table->date('L_Date')->nullable();
            $table->bigInteger('leave_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->text('Leave_Reason')->nullable();
            $table->tinyInteger('Leave_Status')->default(0);
            $table->bigInteger('approved_by')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('leave_id')->references('id')->on('leave_settings')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('leave_requests');
    }
};
