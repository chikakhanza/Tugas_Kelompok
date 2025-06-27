<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
       Schema::create('homestays', function (Blueprint $table) {
    $table->id();
    $table->string('kode');
    $table->string('tipe_kamar');
    $table->integer('harga_sewa_per_hari');
    $table->integer('lama_inap');
    $table->integer('total_bayar');
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('homestays');
    }
};
