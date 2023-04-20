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
        Schema::create('ibus', function (Blueprint $table) {
            $table->id();
            $table->integer('nik');
            $table->string('nama_istri');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('telepon');
            $table->enum('golongan_darah', ['A', 'B', 'O', 'AB']);
            $table->string('nama_suami');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibus');
    }
};
