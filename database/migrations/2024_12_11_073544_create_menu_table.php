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
        Schema::create('menus', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('item_name'); // Item name (e.g., Spaghetti, Pizza)
            $table->decimal('price', 10, 2); // Price (decimal with 2 decimal places)
            $table->text('description')->nullable(); // Item description, nullable
            $table->string('image')->nullable(); // Image path, nullable (for file storage)
            $table->timestamps(); // Created at and updated at timestamps
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
