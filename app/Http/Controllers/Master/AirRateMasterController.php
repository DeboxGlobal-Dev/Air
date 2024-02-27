<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\AirRateMaster;

class AirRateMasterController extends Controller
{
    public function index(Request $request){
        $arrayDataRows = array();

        call_logger('REQUEST COMES FROM AIR RATE LIST: '.$request->getContent());

        $Search = $request->input('Search');
        $Status = $request->input('Status');

        $posts = AirRateMaster::when($Search, function ($query) use ($Search) {
            return $query->where('ClientId', $Search);
        })->when($Status, function ($query) use ($Status) {
             return $query->where('Status',$Status);
        })->select('*')->get('*');

        if ($posts->isNotEmpty()) {
            $arrayDataRows = [];
            foreach ($posts as $post){
                $arrayDataRows[] = [
                    "Id" => $post->id,
                    "ClientId" => $post->ClientId,
                    "AirId" => $post->AirId,
                    "FlightNumber" => $post->FlightNumber,
                    "FlightClass" => $post->FlightClass,
                    "Currency" => $post->Currency,
                    "ValidFrom" => $post->ValidFrom,
                    "ValidTo" => $post->ValidTo,
                    "AdultBaseFare" => $post->AdultBaseFare,
                    "AdultAirlineTax" => $post->AdultAirlineTax,
                    "PersonTotalCost" => $post->PersonTotalCost,
                    "ChildBaseFare" => $post->ChildBaseFare,
                    "ChildAirlineTax" => $post->ChildAirlineTax,
                    "InfantTotalCost" => $post->InfantTotalCost,
                    "InfantBaseFare" => $post->InfantBaseFare,
                    "InfantAirlineTax" => $post->InfantAirlineTax,
                    "TotalCost" => $post->TotalCost,
                    "BaggageAllowance" => $post->BaggageAllowance,
                    "CancellationPolicy" => $post->CancellationPolicy,
                    "Remarks" => $post->Remarks,
                    "Status" => $post->Status,
                    "JsonItem" => $post->JsonItem,
                    "Destination" => $post->Destination,
                    "AddedBy" => $post->AddedBy,
                    "UpdatedBy" => $post->UpdatedBy,
                    "Created_at" => $post->created_at,
                    "Updated_at" => $post->updated_at
                ];
            }

            return response()->json([
                'Status' => 200,
                'TotalRecord' => $posts->count('id'),
                'DataList' => $arrayDataRows
            ]);

        }else {
            return response()->json([
                "Status" => 0,
                "TotalRecord" => $posts->count('id'),
                "Message" => "No Record Found."
            ]);
        }
    }

    public function store(Request $request){

        call_logger('REQUEST COMES FROM ADD/UPDATE Air Rate: '.$request->getContent());

        //try{
            $id = $request->input('id');
            if($id == '') {

                $businessvalidation =array(
                    'ClientId' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                    return $validatordata->errors();
                }else{
                 $savedata = AirRateMaster::create([
                    'ClientId' => $request->ClientId,
                    'AirId' => $request->AirId,
                    'FlightNumber' => $request->FlightNumber,
                    'FlightClass' => $request->FlightClass,
                    'Currency' => $request->Currency,
                    'ValidFrom' => $request->ValidFrom,
                    'ValidTo' => $request->ValidTo,
                    'AdultBaseFare' => $request->AdultBaseFare,
                    'AdultAirlineTax' => $request->AdultAirlineTax,
                    'PersonTotalCost' => $request->PersonTotalCost,
                    'ChildBaseFare' => $request->ChildBaseFare,
                    'ChildAirlineTax' => $request->ChildAirlineTax,
                    'InfantTotalCost' => $request->InfantTotalCost,
                    'InfantBaseFare' => $request->InfantBaseFare,
                    'InfantAirlineTax' => $request->InfantAirlineTax,
                    'TotalCost' => $request->TotalCost,
                    'BaggageAllowance' => $request->BaggageAllowance,
                    'CancellationPolicy' => $request->CancellationPolicy,
                    'Remarks' => $request->Remarks,
                    'Status' => $request->Status,
                    'JsonItem' => $request->getContent(),
                    'Destination' => $request->Destination,
                    'AddedBy' => $request->AddedBy,
                    'created_at' => now()
                ]);

                if ($savedata) {
                    return response()->json(['Status' => 0, 'Message' => 'Data added successfully!']);
                } else {
                    return response()->json(['Status' => 1, 'Message' =>'Failed to add data.'], 500);
                }
              }

            }else{

                $id = $request->input('id');
                $edit = AirRateMaster::find($id);

                $businessvalidation =array(
                    'ClientId' => 'required',
                );

                $validatordata = validator::make($request->all(), $businessvalidation);

                if($validatordata->fails()){
                 return $validatordata->errors();
                }else{
                    if ($edit) {
                        $edit->ClientId = $request->input('ClientId');
                        $edit->AirId = $request->input('AirId');
                        $edit->FlightNumber = $request->input('FlightNumber');
                        $edit->FlightClass = $request->input('FlightClass');
                        $edit->Currency = $request->input('Currency');
                        $edit->ValidFrom = $request->input('ValidFrom');
                        $edit->ValidTo = $request->input('ValidTo');
                        $edit->AdultBaseFare = $request->input('AdultBaseFare');
                        $edit->AdultAirlineTax = $request->input('AdultAirlineTax');
                        $edit->PersonTotalCost = $request->input('PersonTotalCost');
                        $edit->ChildBaseFare = $request->input('ChildBaseFare');
                        $edit->ChildAirlineTax = $request->input('ChildAirlineTax');
                        $edit->InfantTotalCost = $request->input('InfantTotalCost');
                        $edit->InfantBaseFare = $request->input('InfantBaseFare');
                        $edit->InfantAirlineTax = $request->input('InfantAirlineTax');
                        $edit->TotalCost = $request->input('TotalCost');
                        $edit->BaggageAllowance = $request->input('BaggageAllowance');
                        $edit->CancellationPolicy = $request->input('CancellationPolicy');
                        $edit->Remarks = $request->input('Remarks');
                        $edit->Status = $request->input('Status');
                        $edit->UpdatedBy = $request->input('UpdatedBy');
                        $edit->JsonItem = $request->getContent();
                        $edit->Destination = $request->input('Destination');
                        $edit->updated_at = now();
                        $edit->save();

                        return response()->json(['Status' => 0, 'Message' => 'Data updated successfully']);
                    } else {
                        return response()->json(['Status' => 1, 'Message' => 'Failed to update data. Record not found.'], 404);
                    }
                }
            }
        // }catch (\Exception $e){
        //     call_logger("Exception Error  ===>  ". $e->getMessage());
        //     return response()->json(['Status' => -1, 'Message' => 'Exception Error Found']);
        // }
    }


}
