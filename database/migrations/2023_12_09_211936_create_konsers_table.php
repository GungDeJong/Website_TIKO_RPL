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
        Schema::create('konser', function (Blueprint $table) {
            $table->id();
            $table->string('gambar');
            $table->string('nama');
            $table->text('deskripsi');
            $table->string('gambar_kategori_tiket');
            $table->timestamp('tanggal_mulai')->nullable();
            $table->timestamp('tanggal_selesai')->nullable();
            $table->timestamps();
        });

        Schema::create('artis_konser', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artis_id')->constrained('artis')->cascadeOnDelete();
            $table->foreignId('konser_id')->constrained('konser')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('konser_tiket', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artis_id')->constrained('artis')->cascadeOnDelete();
            $table->foreignId('konser_id')->constrained('konser')->cascadeOnDelete();
            $table->string('tipe');
            $table->integer('harga');
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
        Schema::dropIfExists('konser');
        Schema::dropIfExists('artis_konser');
        Schema::dropIfExists('tiket_konser');
    }
};
