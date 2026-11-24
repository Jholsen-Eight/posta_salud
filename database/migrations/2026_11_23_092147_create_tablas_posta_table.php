<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('rol', 20)->default('recepcion');
        });

        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->char('dni', 8)->unique();
            $table->string('nombres', 80);
            $table->string('apellidos', 80);
            $table->date('fecha_nacimiento');
            $table->char('sexo', 1);
            $table->string('telefono', 9)->nullable();
            $table->string('direccion', 150)->nullable();
            $table->timestamps();
        });

        Schema::create('personal_medico', function (Blueprint $table) {
            $table->id();
            $table->char('dni', 8)->unique();
            $table->string('nombres', 80);
            $table->string('apellidos', 80);
            $table->string('especialidad', 60);
            $table->string('colegiatura', 20)->unique();
            $table->boolean('activo')->default(true);
            $table->foreignId('user_id')->nullable()->unique()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });

        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('paciente_id')->constrained('pacientes')->restrictOnDelete();
            $table->foreignId('personal_medico_id')->constrained('personal_medico')->restrictOnDelete();
            $table->dateTime('fecha_hora');
            $table->string('motivo', 200)->nullable();
            $table->string('estado', 20)->default('pendiente');
            $table->timestamps();
        });

        Schema::create('atenciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cita_id')->unique()->constrained('citas')->restrictOnDelete();
            $table->text('diagnostico');
            $table->text('tratamiento')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('atenciones');
        Schema::dropIfExists('citas');
        Schema::dropIfExists('personal_medico');
        Schema::dropIfExists('pacientes');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('rol');
        });
    }
};