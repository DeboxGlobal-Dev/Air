<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;

class FilterAirRateController extends Controller
{
    public function index(Request $request){
    
        $valid_from = $request->input('ValidFrom');
        $valid_to = $request->input('ValidTo');
        $destination = $request->input('Destination');
            
        $RateCode = "V1^V31^M".date('n',strtotime($valid_from))."^D".$destination."^Y".date('Y',strtotime($valid_from));

        $data = DB::select('
            SELECT json_build_array(elem) AS result
            FROM air.search_air_rate, JSON_ARRAY_ELEMENTS("JsonResult") AS elem
            WHERE "RateCode" = \''.$RateCode.'\' and elem->>\'ValidFrom\' <= \''.$valid_from.'\' and elem->>\'ValidTo\' >= \''.$valid_to.'\' and elem->>\'Destination\' = \''.$destination.'\'');

            if($data != null){

                $total_data = array();
                foreach($data as $datas){
        
                    $local_data = json_decode($datas->result);
                    
                    array_push($total_data,$local_data[0]);
                }
                
                return response()->json([
                      'Status' => 200,
                      'DataList' => $total_data,
                  ]); 


            }else{

                return response()->json([
                    'Status' => -1,
                    'DataList' => "Data not Found",
                ]); 

            }

           
    }
}
