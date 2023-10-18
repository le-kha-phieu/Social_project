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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Tiêu đề bài viết');
            $table->string('content')->comment('Nội dung bài viết');
            $table->string('image')->comment('Ảnh bài viết');
            $table->boolean('status')->default(1)->comment('Trạng thái: 1| Chưa duyệt - 2| Đã duyệt');
            $table->bigInteger('user_id')->comment('Mã người dùng');
            $table->bigInteger('category_id')->comment('Mã danh mục');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
