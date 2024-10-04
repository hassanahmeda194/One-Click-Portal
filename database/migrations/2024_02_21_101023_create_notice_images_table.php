<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeImagesTable extends Migration
{
    public function up()
    {
        Schema::create('notice_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('notice_id');
            $table->foreign('notice_id')->references('id')->on('notices')->onDelete('cascade');
            $table->text('filename');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notice_images');
    }
}
