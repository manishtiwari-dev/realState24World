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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('type');
            $table->decimal('amount', 12, 2);
            $table->string('address');
            $table->string('city');
            $table->unsignedBigInteger('state_id');
            $table->string('landmark');
            $table->string('area');
            $table->integer('bedrooms')->nullable();
            $table->integer('accomodation')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('yard_size')->nullable();
            $table->integer('garage')->nullable();
            $table->boolean('wifi')->default(0);
            $table->boolean('pool')->default(0);
            $table->boolean('security')->default(0);
            $table->boolean('laundry')->default(0);
            $table->boolean('equipped_kitchen')->default(0);
            $table->boolean('air_conditioning')->default(0);
            $table->boolean('gym')->default(0);
            $table->boolean('parking')->default(0);
            $table->boolean('airport')->default(0);
            $table->boolean('park')->default(0);
            $table->boolean('busstand')->default(0);
            $table->boolean('mandir')->default(0);
            $table->boolean('hospital')->default(0);
            $table->boolean('school')->default(0);
            $table->boolean('railwaystation')->default(0);
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('multiple_images')->nullable();
            $table->text('metatitle')->nullable();
            $table->longText('metakeyword')->nullable();
            $table->longText('metadescription')->nullable();
            $table->unsignedBigInteger('dealer_id')->nullable();
            $table->enum('status', ['1', '0'])->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
