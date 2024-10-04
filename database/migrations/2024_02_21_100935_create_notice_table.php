<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticeTable extends Migration
{
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->enum('type', ['description', 'image', 'video', 'survey']);
            $table->text('content')->nullable();
            $table->text('time_limit')->nullable();
            $table->text('start_datetime')->nullable();
            $table->text('end_datetime')->nullable();
            $table->bigInteger('created_by')->unsigned()->nullable();
            $table->timestamps();
            $table->tinyInteger('status')->default(0);
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('notices');
    }
}
