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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->string('rentDate');
            $table->string('returnDate');
            $table->foreignId('stallId')->references('id')->on('stalls');
            $table->foreignId('userId')->references('id')->on('users');
            $table->foreignId('costId')->references('id')->on('costs');
            $table->enum('status', ['active', 'inactive']);
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
