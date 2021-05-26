<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artists',function(Blueprint $table){
            $table->id();
            $table->string('artist_name')->default('');
            $table->string('slug')->default('');
            $table->integer('genre_id')->default('0');
            $table->string('artist_image')->default('');
            $table->text('artist_bio');
            $table->string('artist_genre')->default('');
            $table->integer('status')->default('1');
            $table->integer('popularity_sequence')->default('0');
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
        Schema::dropIfExists('artists');
    }
}
