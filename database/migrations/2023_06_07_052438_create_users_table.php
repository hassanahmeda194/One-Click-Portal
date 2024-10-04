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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('EMP_ID');
            $table->string('email')->unique();
            $table->string('password');
            $table->bigInteger('Role_ID')->nullable()->unsigned();
            $table->bigInteger('CID')->nullable()->unsigned();
            $table->bigInteger('Skill_ID')->nullable()->unsigned();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->bigInteger('created_by')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Role_ID')->references('id')->on('user_designations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('CID')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Skill_ID')->references('id')->on('writer_skills')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
