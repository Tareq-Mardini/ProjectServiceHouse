<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfolioGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_galleries', function (Blueprint $table) {
            $table->id(); // مفتاح أساسي
            $table->unsignedBigInteger('portfolio_id'); // مفتاح أجنبي
            $table->string('title'); // عنوان العنصر في المعرض
            $table->string('thumbnail'); // الصورة المصغرة
            $table->string('platform'); // اسم المنصة
            $table->string('link'); // الرابط للعنصر
            $table->timestamps(); // حقول created_at و updated_at

            // إنشاء العلاقة مع جدول portfolios
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_galleries');
    }
}
