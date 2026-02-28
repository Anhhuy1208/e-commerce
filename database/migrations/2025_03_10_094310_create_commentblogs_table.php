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
        Schema::create('commentblogs', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->string('id_user');
            $table->string('id_blog');
            $table->string('avatar_user');
            $table->string('name_user');
            $table->unsignedInteger('level')->default(0)->comments = '1:admin 0:member';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commentblogs');
    }
};
