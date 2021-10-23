<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->enum('payment_type', ['interac', 'cash']);
            $table->string('type'); //Particulier, Entreprise
            $table->enum('reservation_type', ['pre_reservation', 'reservation', 'visit']);

            $table->decimal('security_deposit')->default(0);
            $table->decimal('booking_fees')->default(0);
            $table->decimal('price')->default(0);

            $table->boolean('security_deposit_paid')->default(false);
            $table->boolean('booking_fees_paid')->default(false);
            $table->boolean('price_paid')->default(false);

            $table->integer('guest_number')->nullable();
            $table->text('notes')->nullable();

            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->string('invoice_number')->nullable();
            $table->boolean('confirmation_sent')->default(false);
            $table->boolean('liquor_license_needed')->default(0);

            $table->dateTime('call_date');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
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
        Schema::table('reservations', function(Blueprint $table) {
            $table->dropForeign('reservations_client_id_foreign');
        });
        Schema::dropIfExists('reservations');
    }
}
