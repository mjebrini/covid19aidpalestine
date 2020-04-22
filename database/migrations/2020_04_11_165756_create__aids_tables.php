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
 
        Schema::create('Aid', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 100)->nullable();
            $table->biginteger('owner')->unsigned()->index()->nullable();
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
                ->references('id')->on('Users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('AidActivity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->biginteger('aid_id')->unsigned()->index()->nullable(false);
            $table->biginteger('owner_id')->unsigned()->index()->nullable(false);
            $table->string('activity', 255)->nullable();
            $table->string('notes', 255)->nullable();
            $table->timestamps();
    
            $table->foreign('aid_id')
                ->references('id')->on('Aid')
                ->onDelete('cascade');

            $table->foreign('owner_id')
                ->references('id')->on('Users')
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
        Schema::dropIfExists('AidActivity');
        Schema::dropIfExists('Aid');
    }
}
