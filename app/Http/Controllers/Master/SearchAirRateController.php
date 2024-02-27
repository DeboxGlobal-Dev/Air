<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;


class SearchAirRateController extends Controller
{

    function getCodes($from,$to,$destination){

        $firstmonth = Carbon::parse($from)->format('n');
        $lastmonth = Carbon::parse($to)->format('n');
        $firstyear = Carbon::parse($from)->year;
        $lastyear = Carbon::parse($to)->year;
        $arr = array();
    
        if($firstyear == $lastyear){
    
            for($i = $firstmonth;$i <= $lastmonth;$i++){
                array_push($arr,"V1^V31^M".$i."^D".$destination."^Y".$firstyear);
            }
    
        }else{
    
            for($j = $firstyear;$j <= $lastyear;$j++){
    
                if($j == $firstyear){
    
                    for($z = $firstmonth;$z <= 12;$z++){
                        array_push($arr,"V1^V31^M".$z."^D".$destination."^Y".$j);
                    }
    
                }
                if($j == $lastyear){
    
                    for($z = 1;$z <= $lastmonth;$z++){
                        array_push($arr,"V1^V31^M".$z."^D".$destination."^Y".$j);
                    }
    
                }
                if($j != $firstyear && $j != $lastyear){
    
                    for($z = 1;$z <= 12;$z++){
                        array_push($arr,"V1^V31^M".$z."^D".$destination."^Y".$j);
                    }
    
                }
    
    
            }
    
        }
    
    return $arr;
    
    
    }
    
    public function index(){

        $users = DB::table(_AIR_RATE_MASTER_)->get();

foreach ($users as $user) {

    $startDate = Carbon::parse($user->ValidFrom);
    $endDate = Carbon::parse($user->ValidTo);

    $JsonItem = $user->JsonItem;

    $res = $this->getCodes($startDate,$endDate,$user->Destination);

    $collection = collect($res);

    $collection->each(function ($value) use ($JsonItem) {
            $existingRecord = DB::table(_SEARCH_AIR_RATE_)->where('RateCode', $value)->first();
            if ($existingRecord) {

            $existingData = json_decode($existingRecord->JsonResult,true);

            $newData = json_decode($JsonItem,true);

            $a = array_push($existingData,$newData);

            $finalData = json_encode($existingData, JSON_PRETTY_PRINT);

            try {
                $updateQuery = DB::table(_SEARCH_AIR_RATE_)
                ->where('RateCode', $value)
                ->update(['JsonResult' => $finalData]);
                    call_logger('Updated: '.$value);
                    // Return "yes" if the insertion is successful
                } catch (QueryException $exception) {
                    call_logger('Not Updated: '.$value);
                }

        // 'JsonResult' => DB::raw("JSON_ARRAY_APPEND(JsonResult, '$', CAST('".json_encode($existingData)."' AS JSON))"),
    // ]);

            // YourModel::where('id', $id)->update([
                // 'json_column' => DB::raw("JSON_ARRAY_APPEND(json_column, '$', CAST('".json_encode($newData)."' AS JSON))")
            // ]);




            } else {
                try {
                    DB::table(_SEARCH_AIR_RATE_)->insert([
                        'RateCode' => $value,
                        'JsonResult' => "[".trim($JsonItem)."]"
                    ]);
                    call_logger('Successfull: '.$value);
                    // Return "yes" if the insertion is successful
                } catch (QueryException $exception) {
                    call_logger('Not Successfull: '.$value);
                }


            }

    });

    }

    }
}
