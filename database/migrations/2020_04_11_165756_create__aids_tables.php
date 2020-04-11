<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAidsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('Member', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('email', 255)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable();
            $table->string('provider_name', 100)->nullable();
            $table->string('provider_id', 255)->unique()->nullable();
            $table->string('remember_token', 1000)->nullable();
           
            // picture : "http://graph.facebook.com/" + success.authResponse.userID + "/picture?type=large"
            $table->string('picture', 300)->nullable();

            $table->timestamps();
        });

        Schema::create('Aid', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 100)->nullable();
            $table->integer('owner')->unsigned()->index()->nullable();
            $table->string('category', 255)->nullable();
            $table->string('location', 255)->nullable();
            $table->float('lat', 12, 8)->nullable();
            $table->float('lng', 12, 8)->nullable();
            $table->string('description', 1000)->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->index(
                ['type', 'owner', 'category'],
                'aids_entity_index'
            );
    
            $table->foreign('owner')
                ->references('id')->on('Member')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('AidActivity', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aid_id')->unsigned()->index()->nullable(false);
            $table->integer('owner_id')->unsigned()->index()->nullable(false);
            $table->string('activity', 255)->nullable();
            $table->string('notes', 255)->nullable();
            $table->timestamps();
    
            $table->foreign('aid_id')
                ->references('id')->on('Aid')
                ->onDelete('cascade');

            $table->foreign('owner_id')
                ->references('id')->on('Member')
                ->onDelete('cascade');
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Member');
        Schema::dropIfExists('Aid');
        Schema::dropIfExists('AidActivity');
    }
}
