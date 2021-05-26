<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->string("contact_name");
            $table->string("organizer_name");
            $table->string("email");
            $table->string("country_code");
            $table->string("mob_no");
            $table->string("address");
            $table->string("event_name");
            $table->string("event_date");
            $table->string("tot_guests");
            $table->string("event_payment_type");
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
        Schema::dropIfExists('enquiries');
    }
}
