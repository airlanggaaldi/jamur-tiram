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
        Schema::create('monitorings', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->float('suhu')->default(0);
            $table->float('kelembapan')->default(0);
            $table->string('status_kipas')->default('Mati');
            $table->string('status_mist_maker')->default('Mati');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monitorings');
    }
};