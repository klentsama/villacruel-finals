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
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')->nullable()->constrained('movies')->cascadeOnDelete();
            $table->foreignId('renter_id')->nullable()->constrained('renters')->cascadeOnDelete();
            $table->foreignId('tv_series_id')->nullable()->constrained('tv_series')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->json('images')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_popular')->default(false);
            $table->boolean('in_stock')->default(true);
            $table->boolean('on_sale')->default(true);
            $table->enum('status', ['rented', 'returned', 'overdue'])->default('rented');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
     public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
