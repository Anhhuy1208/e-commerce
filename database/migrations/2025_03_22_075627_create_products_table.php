<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('id_user');
            $table->string('name');
            $table->Integer('price');
            $table->string('id_category');
            $table->string('id_brand');
            $table->unsignedInteger('status')->comments = '1:sale 0:new';
            $table->string('sale');
            $table->string('company');
            $table->string('hinhanh')->nullable();
            $table->string('detail');
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
