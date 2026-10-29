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
        Schema::create('staf', function (Blueprint $t) {
    $t->id();
    $t->string('nama');
    $t->text('alamat');
    $t->date('tanggal_lahir');
    $t->string('tempat_lahir');
    $t->string('no_hp', 20);
    $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staf');
    }
};
