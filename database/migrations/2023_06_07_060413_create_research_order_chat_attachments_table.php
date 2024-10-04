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
        Schema::create('research_order_chat_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('File_Name')->nullable();
            $table->string('file_path')->nullable();
            $table->bigInteger('msg_id')->unsigned();
            $table->timestamps();
            $table->foreign('msg_id')->references('id')->on('research_order_chats')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_order_chat_attachments');
    }
};
