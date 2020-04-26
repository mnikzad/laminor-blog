<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->string('title');
            $table->text('lead');
            $table->longText('body');
            $table->unsignedBigInteger('views')->default(0);
            $table->string('banner_path')->nullable();

            // $table->foreign('user_id')
            //    ->references('id')
            //    ->on('users')
            //    ->onDelete('cascade')
            //    ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
