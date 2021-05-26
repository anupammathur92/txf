<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScannedTicketDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scanned_ticket_details', function (Blueprint $table) {
            $table->id();
            $table->integer("event_id")->default('0');
            $table->integer("booking_id")->default('0');
            $table->integer("ticket_category_id")->default('0');
            $table->integer("user_id")->default('0');
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
        Schema::dropIfExists('scanned_ticket_details');
    }
}
