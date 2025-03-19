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
        Schema::create('snack_shop_reports', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('snack_shop_id');
            $table->bigInteger('cinema_id');
            $table->date('date');
            $table->decimal('opening_balance');
            $table->decimal('sales');
            $table->decimal('save_amount'); // ရုံးချုပ်သို့အပ်ငွေ/ မုန့်ဆိုင်မှလာအပ်သောငွေသား
            $table->decimal('total_expenses');
            $table->decimal('transfer_amount');
            $table->decimal('closing_balance');
            $table->decimal('surplus_deficits');
            $table->decimal('total_surplus_deficits')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('snack_shop_reports');
    }
};
