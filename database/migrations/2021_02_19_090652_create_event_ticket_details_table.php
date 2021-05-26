<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTicketDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_ticket_details', function (Blueprint $table) {
            $table->id();
            $table->integer("event_id")->defualt('0');
            $table->integer("ticket_category_id")->defualt('0');
            $table->integer('total_tickets')->default(0);
            $table->integer('max_ticket_per_user')->default(0);
            $table->decimal('admin_comm',$precision = 6,$scale = 2)->default('0.00');
            $table->decimal('per_ticket_price',$precision = 6,$scale = 2)->default('0.00');
            $table->string('available_tickets')->default('0');
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
        Schema::dropIfExists('event_ticket_details');
    }
}
