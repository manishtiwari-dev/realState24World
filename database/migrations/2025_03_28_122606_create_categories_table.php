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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('shortdescription')->nullable();
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('banner')->nullable();
            $table->string('mobile_banner')->nullable();
            $table->text('metatitle')->nullable();
            $table->text('metakeyword')->nullable();
            $table->longText('metadescription')->nullable();
            $table->integer('display_order')->nullable();
            $table->enum('show_menu', ['1', '0'])->default('0');
            $table->enum('show_home', ['1', '0'])->default('0');
            $table->enum('status', ['1', '0'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
