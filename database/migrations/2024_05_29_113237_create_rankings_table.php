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
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('bobot', 3, 2);
            $table->string('jenis');
            $table->timestamps();
        });

        Schema::create('alternatives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade');
            $table->decimal('c1', 15, 14)->nullable();
            $table->decimal('c2', 15, 14)->nullable();
            $table->decimal('c3', 15, 14)->nullable();
            $table->decimal('c4', 15, 14)->nullable();
            $table->decimal('c5', 15, 14)->nullable();
            $table->decimal('nilai', 15, 14);
            $table->timestamps();
        });

        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alternative_id')->constrained()->onDelete('cascade');
            $table->decimal('c1', 15, 14)->nullable();
            $table->decimal('c2', 15, 14)->nullable();
            $table->decimal('c3', 15, 14)->nullable();
            $table->decimal('c4', 15, 14)->nullable();
            $table->decimal('c5', 15, 14)->nullable();
            $table->decimal('score', 15, 14);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criterias');
        Schema::dropIfExists('rankings');
        Schema::dropIfExists('alternatives');
    }
};
