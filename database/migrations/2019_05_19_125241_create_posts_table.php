<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');

            $table->string('name')->comment('标题');
            $table->string('des')->nullable()->comment('简介');
            $table->string('image')->nullable()->comment('图片');
            $table->string('content')->comment('详情');
            $table->string('video_url')->nullable()->comment('视频地址');

            $table->string('cat_slug')->nullable()->comment('分类别名');

            $table->timestamps();
            $table->softDeletes();
            
            $table->index(['id', 'created_at']);
            $table->index('cat_slug');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
