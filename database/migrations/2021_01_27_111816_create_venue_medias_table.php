<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenueMediasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venue_medias', function (Blueprint $table){
            $table->id();
            $table->integer("venue_id")->default('0');
            $table->string("media_type")->default('');
            $table->string("video_embed_code")->default('');
            $table->string("image_media")->default('');
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
        Schema::dropIfExists('venue_medias');
    }
}
