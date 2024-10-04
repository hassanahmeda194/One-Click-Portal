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
        Schema::create('user_basic_infos', static function (Blueprint $table) {
            $table->id();
            $table->string('F_Name');
            $table->string('L_Name')->nullable();
            $table->string('Phone_Number');
            $table->dateTime('DOB')->nullable();
            $table->string('CNIC_Number');
            $table->dateTime('Join_Date');
            $table->dateTime('Permanent_Date');
            $table->bigInteger('Dep_ID')->nullable()->unsigned();
            $table->tinyInteger('EMP_Status')->default(1);
            $table->tinyInteger('Probation_Period')->default(0);
            $table->string('Job_Type');
            $table->double('Basic_Salary');
            $table->string('profile_photo_path')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('Dep_ID')->references('id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('user_basic_infos');
    }
};
