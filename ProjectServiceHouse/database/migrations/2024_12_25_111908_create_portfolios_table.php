<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id(); // مفتاح أساسي
            $table->unsignedBigInteger('supplier_id')->unique(); // مفتاح أجنبي مع خاصية Unique للعلاقة One-to-One
            $table->text('about_me'); // نص كبير للمعلومات الشخصية
            $table->string('language'); // لغة البرتفوليو
            $table->timestamps(); // حقول created_at و updated_at

            // إنشاء العلاقة مع جدول suppliers
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolios');
    }
}