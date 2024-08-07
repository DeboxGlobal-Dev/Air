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
        Schema::table(_AIR_RATE_MASTER_, function (Blueprint $table) {
            $table->json('adult_cost')->nullable();
            $table->json('child_cost')->nullable();
            $table->json('infant_cost')->nullable();

            $table->foreign('AirId')
            ->references('id')
            ->on(_AIRLINE_MASTER_)
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(_AIR_RATE_MASTER_, function (Blueprint $table) {
            $table->dropColumn('adult_cost');
            $table->dropColumn('child_cost');
            $table->dropColumn('infant_cost');
        });
    }
};
