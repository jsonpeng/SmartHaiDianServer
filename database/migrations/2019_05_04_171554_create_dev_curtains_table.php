<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevCurtainsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dev_curtains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('me');
            $table->string('model');
            $table->string('name');
            $table->integer('state');
            $table->integer('motion_type');
            $table->integer('percent');
            $table->string('agt');
            $table->integer('agt_state');
            $table->integer('region_id');
            $table->integer('is_join');
            $table->string('join_at');
            $table->string('idx');
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
        Schema::drop('dev_curtains');
    }
}
