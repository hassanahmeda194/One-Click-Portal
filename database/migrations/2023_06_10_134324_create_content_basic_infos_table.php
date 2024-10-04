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
        Schema::create('content_basic_infos', static function (Blueprint $table) {
            $table->id();
            $table->string('Content_Title');
            $table->string('Industry_Name');
            $table->string('Writing_Style');
            $table->string('Preferred_Voice');
            $table->tinyInteger('Target_Audience')->default(0);
            $table->tinyInteger('Target_Gender')->default(0);
            $table->tinyInteger('Free_Image')->default(0);
            $table->string('Generic_Type');
            $table->string('Keywords')->nullable();
            $table->text('Meta_Description')->nullable();
            $table->string('Reference_Link')->nullable();
            $table->string('Order_Services');
            $table->double('Word_Count')->default(0)->unsigned();
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
    public function down(): void
    {
        Schema::dropIfExists('content_basic_infos');
    }
};
