<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_barangs')->constrained('barangs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_keranjangs')->constrained('keranjangs')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('jumlah_barang');
            $table->integer('jumlah_harga');
            $table->integer('bayar')->nullable();
            $table->integer('kembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pembayarans');
    }
}
