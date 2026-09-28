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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->text("description");
            $table->string('status')->default('Pending');
            $table->timestamps();

            $table->foreignId('created_by_id')
            ->constrained("users")
            ->cascadeOnDelete();
            
            $table->foreignId('assigned_to_id')
            ->nullable()
            ->nullOnDelete()
            ->constrained("users");
            
            $table->foreignId('category_id')
            ->constrained()
            ->restrictOnDelete();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};


