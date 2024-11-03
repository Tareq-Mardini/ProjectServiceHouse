<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkImagesTable extends Migration
{
    public function up()
    {
        Schema::create('work_images', function (Blueprint $table) {
            $table->id(); // تعريف حقل `id` كالمفتاح الأساسي
            $table->foreignId('work_id')->constrained()->onDelete('cascade'); // تعريف علاقة الصورة بالعمل
            $table->string('image_path'); // حقل `image_path` لتخزين مسار الصورة
            $table->timestamps(); // حقول `created_at` و`updated_at` للوقت
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_images'); // حذف الجدول عند التراجع
    }
}