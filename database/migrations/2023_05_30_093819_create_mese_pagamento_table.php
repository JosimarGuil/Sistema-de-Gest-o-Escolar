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
        Schema::create('mese_pagamento', function (Blueprint $table) {
            $table->foreignId('pagamento_id')->constrained('pagamentos')
            ->onDelete('cascade');

            $table->foreignId('mese_id')->constrained('meses')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mese_pagamento');
    }
};
