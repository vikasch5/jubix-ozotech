<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('copyright')->nullable()->after('email');
            $table->text('available_pincodes')->nullable()->after('copyright');
            $table->text('delivery_charges')->nullable()->after('available_pincodes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('copyright');
            $table->dropColumn('available_pincodes');
            $table->dropColumn('delivery_charges');
        });
    }
};
