<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AirRateMaster extends Model
{
    use HasFactory;
    protected $table = _AIR_RATE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ClientId', 'AirId', 'FlightNumber', 'FlightClass', 'Currency', 'ValidFrom', 'ValidTo', 'AdultBaseFare', 'AdultAirlineTax',
        'PersonTotalCost', 'ChildBaseFare', 'ChildAirlineTax', 'InfantTotalCost', 'InfantBaseFare', 
        'InfantAirlineTax', 'TotalCost', 'BaggageAllowance', 'CancellationPolicy', 'Remarks', 'Status',
        'JsonItem', 'Destination', 'AddedBy', 'UpdatedBy', 'created_at', 'updated_at'
    ];
    public $timestamps = false;
}
