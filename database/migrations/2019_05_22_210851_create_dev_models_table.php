<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevModelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dev_models', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('模型分类名称');
            $table->string('image')->nullable()->comment('模型图片');
            $table->string('model')->comment('模型别名');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('dev_models');
    }
}
