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
        Schema::table('posts', function (Blueprint $table) {

            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('posts', function (Blueprint $table) {

            $table->foreign('category_id')->references('id')->on('categories');
        });

        Schema::table('post_tag', function (Blueprint $table) {

            $table->foreign('post_id')->references('id')->on('posts');
            
        });

        Schema::table('post_tag', function (Blueprint $table) {

            $table->foreign('tag_id')->references('id')->on('tags');
            
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });

        Schema::table('post_tag', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
        });

        Schema::table('post_tag', function (Blueprint $table) {
            $table->dropForeign(['tag_id']);
        });
                    


    }
};
