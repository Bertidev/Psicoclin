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
        Schema::create('consultas', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_paciente');
            $table->unsignedBigInteger('id_psicologo');
            $table->foreign('id_paciente')->references('id')->on('users');
            $table->foreign('id_psicologo')->references('id')->on('users');
            $table->date('data');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
