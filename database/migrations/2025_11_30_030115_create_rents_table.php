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
            $table->foreignId('tv_series_id')->nullable()->constrained('tv_series')->cascadeOnDelete();
            $table->string('name');
            $table->string('type');
            $table->json('images')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('price', 10, 2);
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
        Schema::table('rents', function (Blueprint $table) {
            // Drop the foreign key constraint first, then the column
            $table->dropForeign(['genre_id']);
            $table->dropColumn('genre_id');
        });
    }
};
