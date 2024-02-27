<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchAirRate extends Model
{
    use HasFactory;
    protected $table = _SEARCH_AIR_RATE_;
    protected $primarykey = 'id';
    protected $fillable = [
        'RateCode', 'JsonResult'
    ];
    public $timestamps = false;
}
