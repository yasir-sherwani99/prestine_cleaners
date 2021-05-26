<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->date('invoice_date');
            $table->date('due_date');
            $table->string('payment_terms')->nullable();
            $table->decimal('sub_total', 8,2);
            $table->decimal('tax', 8,2)->default(0);
            $table->decimal('discount', 8,2)->default(0);
            $table->decimal('total', 8,2);
            $table->boolean('is_draft')->default(0);
            $table->boolean('is_cancelled')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
