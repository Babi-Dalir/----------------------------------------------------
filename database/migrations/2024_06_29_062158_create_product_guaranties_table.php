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
        Schema::create('product_guaranties', function (Blueprint $table) {
            $table->id();
            $table->integer('main_price')->default(0);
            $table->integer('price')->default(0); //قیمت تخفیف خورده
            $table->integer('discount')->default(0);//تخفیف ها
            $table->integer('count')->default(0); //شمارش
            $table->integer('max_sell')->nullable(); //حد فروش
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('color_id');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->unsignedBigInteger('guaranty_id'); //گارانتی
            $table->foreign('guaranty_id')->references('id')->on('guaranties');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamp('spacial_start')->nullable(); //فروش فوق العاده
            $table->timestamp('spacial_expiration')->nullable(); //تاریخ انقضا برای فروش فوق العاده
            $table->string('status')->default(ProductStatus::Waiting->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_guaranties');
    }
};
