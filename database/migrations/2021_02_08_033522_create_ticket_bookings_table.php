<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->default("0");
            $table->integer("event_ticket_id")->default("0");
            $table->integer("event_id")->default("0");
            $table->string("payment_id")->default("0");
            $table->string("no_of_tickets")->default("0");
            $table->string("per_ticket_price")->default("0");
            $table->string("tot_amount")->default("0");
            $table->string("admin_comm")->default("0");
            $table->string("admin_comm_val")->default("0");
            $table->string("qrcode_link")->default("");
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
        Schema::dropIfExists('ticket_bookings');
    }
}
