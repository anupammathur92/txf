<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name')->default('');
            $table->string('slug')->default('');
            $table->integer('venue_id')->default(0);
            $table->integer('category_id')->default(0);
            $table->text('description');
            $table->integer('is_featured')->default(0);
            $table->string('event_logo')->default('');
            $table->string('event_header_image')->default('');
            $table->string('organizer')->default('');
            $table->string('status')->default(1);
            $table->date('event_date', $precision = 0);
            $table->string('event_time')->default('');
            $table->string('event_end_time')->default('');
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
        Schema::dropIfExists('events');
    }
}
