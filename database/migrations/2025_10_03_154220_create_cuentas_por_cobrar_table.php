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
        Schema::create('cuentas_por_cobrar', function (Blueprint $table) {
            $table->id();
            $table->foreignId('metodo_de_pago_id')->constrained('metodos_de_pagos'); // Asumiendo una tabla 'metodos_de_pagos'
            $table->foreignId('factura_id')->constrained('facturas');
            $table->decimal('montoPagado', 10, 2);
            $table->decimal('montoPendiente', 10, 2);
            $table->decimal('montoTotal', 10, 2);
            $table->date('fechaVencimiento');
            $table->string('estado');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuentas_por_cobrar');
    }
};
