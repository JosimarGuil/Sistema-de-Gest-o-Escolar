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
        Schema::create('alunos', function (Blueprint $table) {
            $table->id();
            $table->string('nome',50);
            $table->string('email')->unique()->nullable();
            $table->Date('data');
            $table->string('localiza',35);
            $table->integer('fone')->unique();
            $table->foreignId('clace_id')->constrained('claces')
            ->onDelete('cascade');
            $table->foreignId('turma_id')->constrained('turmas')
            ->onDelete('cascade');
            $table->string('img');
            $table->string('doc');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alunos');
    }
};
