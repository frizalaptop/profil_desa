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
        Schema::table('umkms', function (Blueprint $table) {
            DB::table('umkms')->where('category', 'Kerajinan')->update(['category' => 'BUMDES']);
            DB::table('umkms')->where('category', 'Jasa')->update(['category' => 'BUMDES']);
            DB::table('umkms')->where('category', 'Lainnya')->update(['category' => 'BUMDES']);

            // Ubah tipe kolom enum
            Schema::table('umkms', function (Blueprint $table) {
                $table->enum('category', ['Makanan', 'BUMDES', 'Pertanian'])
                    ->default('BUMDES')
                    ->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('umkms', function (Blueprint $table) {
            Schema::table('umkms', function (Blueprint $table) {
                $table->enum('category', ['Makanan', 'Kerajinan', 'Pertanian', 'Jasa', 'Lainnya'])
                    ->default('Lainnya')
                    ->change();
            });
        });
    }
};
