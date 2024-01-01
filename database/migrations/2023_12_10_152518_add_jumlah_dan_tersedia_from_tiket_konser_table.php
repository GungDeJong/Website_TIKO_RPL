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
        Schema::table('konser_tiket', function (Blueprint $table) {
            $table->integer('jumlah');
            $table->integer('sisa');
            $table->dropConstrainedForeignId('artis_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('konser_tiket', function (Blueprint $table) {
            $table->dropColumn('jumlah');
            $table->dropColumn('sisa');
            $table->foreignId('konser_id')->nullable()->constrained('konser')->cascadeOnDelete();
        });
    }
};
