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
        Schema::create('order_revision_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('File_Name')->nullable();
            $table->string('file_path')->nullable();
            $table->bigInteger('revision_id')->unsigned();
            $table->timestamps();
            $table->foreign('revision_id')->references('id')->on('order_revisions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_revision_attachments');
    }
};
