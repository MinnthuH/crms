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
        Schema::create('cinema_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cinema_id');
            $table->bigInteger('hall_id');
            $table->bigInteger('movie_id');
            $table->date('show_date');
            $table->bigInteger('showtime_id');
            $table->bigInteger('ticketprice_id');
            $table->bigInteger('2000')->nullable();
            $table->bigInteger('2500')->nullable();
            $table->bigInteger('3000')->nullable();
            $table->bigInteger('3500')->nullable();
            $table->bigInteger('4000')->nullable();
            $table->bigInteger('4500')->nullable();
            $table->bigInteger('5000')->nullable();
            $table->bigInteger('5500')->nullable();
            $table->bigInteger('6000')->nullable();
            $table->bigInteger('6500')->nullable();
            $table->bigInteger('7000')->nullable();
            $table->bigInteger('7500')->nullable();
            $table->bigInteger('8000')->nullable();
            $table->bigInteger('8500')->nullable();
            $table->bigInteger('9000')->nullable();
            $table->bigInteger('9500')->nullable();
            $table->bigInteger('10000')->nullable();
            $table->bigInteger('10500')->nullable();
            $table->bigInteger('12000')->nullable();
            $table->bigInteger('16000')->nullable();
            $table->bigInteger('17500')->nullable();
            $table->bigInteger('20000')->nullable();
            $table->bigInteger('22500')->nullable();
            $table->bigInteger('25000')->nullable();
            $table->bigInteger('30000')->nullable();
            $table->bigInteger('total_seats');
            $table->bigInteger('total_revenue');
            $table->string('EPC');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cinema_reports');
    }
};
