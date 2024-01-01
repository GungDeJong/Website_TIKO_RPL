<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->foreignId('metode_pembayaran_id')->nullable()->constrained('metode_pembayaran');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('konser_id')->constrained('konser')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('konser_tiket_id')->constrained('konser_tiket')->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('transaksi');
    }
};
