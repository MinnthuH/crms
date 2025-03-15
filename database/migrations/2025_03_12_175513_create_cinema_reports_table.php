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
            $table->bigInteger('user_id');
            $table->bigInteger('cinema_id');
            $table->bigInteger('hall_id');
            $table->bigInteger('movie_id');
            $table->date('show_date');
            $table->bigInteger('showtime_id');
            $table->bigInteger('2000')->default(0);
            $table->bigInteger('2500')->default(0);
            $table->bigInteger('3000')->default(0);
            $table->bigInteger('3500')->default(0);
            $table->bigInteger('4000')->default(0);
            $table->bigInteger('4500')->default(0);
            $table->bigInteger('5000')->default(0);
            $table->bigInteger('5500')->default(0);
            $table->bigInteger('6000')->default(0);
            $table->bigInteger('6500')->default(0);
            $table->bigInteger('7000')->default(0);
            $table->bigInteger('7500')->default(0);
            $table->bigInteger('8000')->default(0);
            $table->bigInteger('8500')->default(0);
            $table->bigInteger('9000')->default(0);
            $table->bigInteger('9500')->default(0);
            $table->bigInteger('10000')->default(0);
            $table->bigInteger('10500')->default(0);
            $table->bigInteger('12000')->default(0);
            $table->bigInteger('16000')->default(0);
            $table->bigInteger('17500')->default(0);
            $table->bigInteger('20000')->default(0);
            $table->bigInteger('22500')->default(0);
            $table->bigInteger('25000')->default(0);
            $table->bigInteger('30000')->default(0);
            $table->bigInteger('total_seats');
            $table->bigInteger('total_revenue');
            $table->string('epc_id');
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
