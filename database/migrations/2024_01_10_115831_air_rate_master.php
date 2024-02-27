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
        Schema::create(_AIR_RATE_MASTER_, function (Blueprint $table) {
            $table->id();
            $table->integer('ClientId');
            $table->integer('AirId');
            $table->string('FlightNumber');
            $table->integer('FlightClass');
            $table->integer('Currency');
            $table->string('ValidFrom');
            $table->string('ValidTo');
            $table->integer('AdultBaseFare');
            $table->integer('AdultAirlineTax');
            $table->integer('PersonTotalCost');
            $table->integer('ChildBaseFare');
            $table->integer('ChildAirlineTax');
            $table->integer('InfantTotalCost');
            $table->integer('InfantBaseFare');
            $table->integer('InfantAirlineTax');
            $table->integer('TotalCost');
            $table->text('BaggageAllowance');
            $table->text('CancellationPolicy');
            $table->text('Remarks');
            $table->integer('Status')->default(0);
            $table->json('JsonItem');
            $table->string('Destination');
            $table->integer('AddedBy')->default(0);
            $table->integer('UpdatedBy')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
