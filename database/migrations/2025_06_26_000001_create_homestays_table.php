<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('homestays', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('tipe_kamar');
            $table->decimal('harga_sewa_per_hari', 10, 2)->unsigned();
            $table->unsignedInteger('lama_inap');
            $table->decimal('total_bayar', 12, 2)->unsigned()->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('homestays');
    }
};
