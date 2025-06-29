<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('homestays', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('tipe_kamar');
            $table->integer('harga_sewa_per_hari');
            $table->text('fasilitas')->nullable();
            $table->integer('jumlah_kamar');
            $table->integer('lama_inap');
            $table->integer('total_bayar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('homestays');
    }
};
