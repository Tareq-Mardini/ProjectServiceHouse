<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id(); // مفتاح أساسي
            $table->unsignedBigInteger('portfolio_id'); // مفتاح أجنبي
            $table->string('title'); // عنوان المهارة
            $table->text('description')->nullable(); // وصف المهارة
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
        Schema::dropIfExists('skills');
    }
}
