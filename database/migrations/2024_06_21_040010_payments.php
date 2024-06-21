<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('paymentDate');
            $table->string('paymentMethod');
            $table->string('paymentProof')->nullable();
            $table->foreignId('rentId')->references('id')->on('rents');
            $table->enum('status', ['paid', 'unpaid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
