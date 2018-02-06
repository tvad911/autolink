<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatedLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->unique();

            $table->string('a123link')->unique();
            $table->string('shorte')->unique();
            $table->string('megaurl')->unique();

            $table->string('googl_url')->unique();
            $table->string('bitly_url')->unique();
            $table->string('anotedpad_url')->unique();
            $table->string('tiny_url')->unique();

            $table->string('source', 1024)->nullable();
            $table->string('destination', 1024)->nullable();
            $table->integer('user_id')->nullable();
            $table->tinyInteger('api_default')->default('1');
            $table->tinyInteger('status')->default('1');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link');
    }
}
