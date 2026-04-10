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
        Schema::table('products', function (Blueprint $table) {
           $table->decimal('sale_price', 10, 2)->nullable()->after('price');
           $table->json('specifications')->nullable()->after('description');
           $table->json('delivery_charges')->nullable()->after('specifications');
           $table->json('courier_charges')->nullable()->after('delivery_charges');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['sale_price', 'specifications', 'delivery_charges', 'courier_charges']);
        });
    }
};
