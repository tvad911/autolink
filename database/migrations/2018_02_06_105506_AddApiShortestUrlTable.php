<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApiShortestUrlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('acl_users', function (Blueprint $table) {
            $table->string('api_123link', 255)->nullable();
            $table->string('api_shortes', 255)->nullable();
            $table->string('api_megaurl', 255)->nullable();

            $table->string('api_bitly', 255)->nullable();
            $table->string('api_googl', 255)->nullable();
            $table->string('api_anotedpad', 255)->nullable();
            $table->string('api_tiny', 255)->nullable();

            $table->tinyInteger('api_default')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('acl_users', function (Blueprint $table) {
            $table->dropColumn(['api_123link']);
            $table->dropColumn(['api_shortes']);
            $table->dropColumn(['api_megaurl']);
            $table->dropColumn(['api_googl']);
            $table->dropColumn(['api_bitly']);
            $table->dropColumn(['api_anotedpad']);
            $table->dropColumn(['api_tiny']);
        });
    }
}