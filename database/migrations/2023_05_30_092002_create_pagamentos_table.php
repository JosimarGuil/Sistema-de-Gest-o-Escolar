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
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tipo_pagamento_id')
            ->nullable()
            ->constrained('tipo_pagamentos')
            ->onDelete('cascade');
            $table->foreignId('aluno_id')->nullable()->constrained('alunos')
            ->onDelete('cascade');
            $table->foreignId('funcionario_id')->nullable()->constrained('funcionarios')
            ->onDelete('cascade');
            $table->decimal('total');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagamentos');
    }
};
