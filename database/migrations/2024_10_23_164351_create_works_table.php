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
        Schema::create('works', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('service_id');
                $table->foreign('services')->references('id')->on('services')->onDelete('cascade');
                $table->unsignedBigInteger('supplier_id');
                $table->foreign('supplier')->references('id')->on('suppliers')->onDelete('cascade');
                $table->string('title');
                $table->string('description');
                $table->float('price');
                $table->string('image')->nullable();
                $table->string('attachments')->nullable();
                $table->softDeletes();
                $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('works');
    }
};
