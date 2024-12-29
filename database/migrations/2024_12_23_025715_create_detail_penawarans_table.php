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
            $table->unsignedBigInteger('penawaran_id');
            $table->unsignedBigInteger('produk_id');    
            $table->foreign('penawaran_id')->references('id')->on('penawarans')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('produks')->onDelete('cascade');
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
