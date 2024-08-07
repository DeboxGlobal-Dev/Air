<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirRateMaster extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = _AIR_RATE_MASTER_;
    protected $primarykey = 'id';
    protected $fillable = [
        'ClientId',
        'AirId',
        'FlightNumber',
        'FlightClass',
        'Currency',
        'adult_cost',
        'child_cost',
        'infant_cost',
        'BaggageAllowance',
        'CancellationPolicy',
        'Remarks',
        'Status',
        'JsonItem',
        'AddedBy',
        'UpdatedBy',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'adult_cost' => 'array',
        'child_cost' => 'array',
        'infant_cost' => 'array'
    ];

    public $timestamps = false;
}
