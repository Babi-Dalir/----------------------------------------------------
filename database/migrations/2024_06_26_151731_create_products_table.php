<?php

use App\Enums\ProductStatus;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('etitle');
            $table->string('slug');
            $table->integer('price')->default(0);
            $table->integer('discount')->default(0);//تخفیف ها
            $table->integer('count')->default(0); //شمارش
            $table->integer('max_sell')->nullable(); //حد فروش
            $table->integer('viewed')->default(0);
            $table->integer('sold')->default(0); //تعداد فروخته شده
            $table->string('image')->nullable();
            $table->unsignedBigInteger('guaranty_id')->nullable(); //گارانتی
            $table->text('description')->nullable();
            $table->timestamp('spacial_start')->nullable(); //فروش فوق العاده
            $table->timestamp('spacial_expiration')->nullable(); //تاریخ انقضا برای فروش فوق العاده
            $table->string('status')->default(ProductStatus::Waiting->value);
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
