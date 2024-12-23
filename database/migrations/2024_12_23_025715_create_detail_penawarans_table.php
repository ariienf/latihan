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
        Schema::create('detail_penawarans', function (Blueprint $table) {
            $table->id();
            $table->integer('jumlah');
            $table->integer('subtotal');
            $table->integer('penawaran_id');
            $table->integer('produk_id');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penawarans');
    }
};
