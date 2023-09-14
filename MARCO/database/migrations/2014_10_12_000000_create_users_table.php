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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nome_completo');
            $table->string('cpf')->unique();
            $table->string('email')->unique();
            $table->string('telefone');
            $table->string('cep');
            $table->string('endereco');
            $table->string('numero_casa');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->date('data_nascimento');
            $table->string('status_usuario');
            $table->string('senha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
