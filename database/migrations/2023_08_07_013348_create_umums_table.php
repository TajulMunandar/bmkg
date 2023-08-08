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
        Schema::create('umums', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->nullable();
            $table->text('survei');
            $table->text('pembayaran');
            $table->string('name');
            $table->string('email');
            $table->text('alamat');
            $table->string('perolehan');
            $table->string('instansi');
            $table->string('hp', 14);
            $table->string('peruntuk');
            $table->string('bentuk_informasi');
            $table->text('surat_LP');
            $table->text('ktp');
            $table->string('unsur');
            $table->string('jenis_informasi');
            $table->text('ket');
            $table->string('lokasi');
            $table->string('PWaktu');
            $table->string('panjang_data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umums');
    }
};
