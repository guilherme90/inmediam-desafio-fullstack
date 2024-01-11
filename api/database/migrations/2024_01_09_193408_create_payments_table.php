<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id');
            $table->bigInteger('parent_id')->nullable();
            $table->decimal('price_contracted', 13, 2);
            $table->decimal('balance', 13, 2, true);
            $table->decimal('price_paid', 13, 2);
            $table->enum('type_invoice', ['credit', 'debit']);
            $table->enum('type_payment', ['pix', 'credit_card', 'billet'])->nullable();
            $table->enum('status', ['pending', 'paid']);
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
        Schema::dropIfExists('payments');
    }
};
