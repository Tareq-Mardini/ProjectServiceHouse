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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('work_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('supplier_id');
            $table->decimal('price', 10, 2);
            $table->text('order_description')->nullable();
            $table->string('selected_offers')->nullable();
            $table->enum('order_status', ['waitings', 'delivered', 'approved'])->default('waitings');
            $table->enum('payment_status', ['paid_to_system', 'released_to_supplier'])->default('paid_to_system');
            $table->enum('supplier_status', ['waitings', 'acceptance', 'rejection', 'completed'])->default('waitings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
