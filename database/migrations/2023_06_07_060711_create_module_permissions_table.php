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
        Schema::create('module_permissions', static function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('Research_view')->default(0);
            $table->tinyInteger('Research_list')->default(0);
            $table->tinyInteger('Research_create')->default(0);
            $table->tinyInteger('Research_edit')->default(0);
            $table->tinyInteger('Research_delete')->default(0);
            $table->tinyInteger('Research_detail')->default(0);

            $table->tinyInteger('Content_view')->default(0);
            $table->tinyInteger('Content_list')->default(0);
            $table->tinyInteger('Content_create')->default(0);
            $table->tinyInteger('Content_edit')->default(0);
            $table->tinyInteger('Content_delete')->default(0);
            $table->tinyInteger('Content_detail')->default(0);

            $table->tinyInteger('Website_view')->default(0);
            $table->tinyInteger('Website_list')->default(0);
            $table->tinyInteger('Website_create')->default(0);
            $table->tinyInteger('Website_edit')->default(0);
            $table->tinyInteger('Website_delete')->default(0);
            $table->tinyInteger('Website_detail')->default(0);

            $table->tinyInteger('home_Order_view')->default(0);
            $table->tinyInteger('home_Order_list')->default(0);
            $table->tinyInteger('home_Order_create')->default(0);
            $table->tinyInteger('home_Order_update')->default(0);
            $table->tinyInteger('home_Order_delete')->default(0);

            $table->tinyInteger('Confirmation_view')->default(0);
            $table->tinyInteger('Confirmation_list')->default(0);
            $table->tinyInteger('Confirmation_create')->default(0);
            $table->tinyInteger('Confirmation_update')->default(0);
            $table->tinyInteger('Confirmation_delete')->default(0);

            $table->tinyInteger('deadline_view')->default(0);
            $table->tinyInteger('deadline_list')->default(0);
            $table->tinyInteger('deadline_create')->default(0);
            $table->tinyInteger('deadline_update')->default(0);
            $table->tinyInteger('deadline_delete')->default(0);
            $table->bigInteger('role_id')->unsigned();
            $table->timestamps();
            $table->foreign('role_id')->references('id')->on('user_designations')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('module_permissions');
    }
};
