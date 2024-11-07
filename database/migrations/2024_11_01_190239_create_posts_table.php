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
            $table->string('title');
            $table->text('content')->nullable();
            $table->unsignedBigInteger('likes')->nullable();
            $table->boolean('is_published')->default(1);
            $table->timestamps();
				//Колонка мягкого удаления
				$table->softDeletes();

				//Нуллабельная колонка оочень большого размера
				$table->unsignedBigInteger('category_id')->nullable();
				//Индекс, который помогает нам легче обращаться к записи в таблице
				$table->index('category_id', 'post_category_idx');
				//Задаем ключ посредством которого мы связываемся с таблицей "категории"
				$table->foreign('category_id', 'post_category_fk')->on('categories')->references('id');
			
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
