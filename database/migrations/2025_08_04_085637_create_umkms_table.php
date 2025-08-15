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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['Makanan', 'Kerajinan', 'Pertanian', 'Jasa', 'Lainnya']);
            $table->string('owner');
            $table->string('phone');
            $table->text('address');
            $table->text('description');
            $table->text('gmaps_embed');
            $table->string('product_photo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
