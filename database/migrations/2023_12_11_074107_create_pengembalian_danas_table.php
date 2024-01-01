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
        Schema::create('pengembalian_dana', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tiket_id')->nullable()->constrained('tiket');
            $table->integer('harga');
            $table->string('nama_bank');
            $table->string('nomor_rekening');
            $table->string('pemilik');
            $table->integer('status');
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
        Schema::dropIfExists('pengembalian_dana');
    }
};
