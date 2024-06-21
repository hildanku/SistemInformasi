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
        Schema::create('userDetails', function (Blueprint $table) {
            $table->id();
            $table->string('businessName');
            $table->string('ownerFullName');
            $table->string('ownerPhoneNumber');
            $table->timestamp('businessPhoto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userDetails');
    }
};
