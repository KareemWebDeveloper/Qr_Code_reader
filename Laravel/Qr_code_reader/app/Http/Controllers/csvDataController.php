<?php

namespace App\Http\Controllers;

use App\Events\CsvDataSaved;
use App\Models\CsvData;
use App\Models\User;
use Auth;
use DB;
use Illuminate\Http\Request;
use Validator;

class csvDataController extends Controller
{
    public function saveData(Request $request , $id){
        $csvData = $request->toArray();
        $userId = $id;
        $rowsCount = count($csvData);
        $SSN = collect($csvData)->pluck('SSN'); // get the SSN values from the csvData
        $validator = Validator::make($csvData,[
            '*.SSN'=> 'required',
            '*.FIRSTNAME'=> 'required',
            '*.LASTNAME'=> 'required',
            '*.GRADE'=> 'required',
            '*.user_id'=> 'required',
        ]);
        if($validator->fails()){
            return response()->json(['message' => $validator->errors()],422);
        }
        else{
        DB::table('csv_data')->upsert($csvData,['SSN'],['GRADE','FINAL','user_id','TEST1','TEST2','TEST3','TEST4']);

        foreach($SSN as $ssn){  // loop on all the SSN of the entered values to check each row was inserted or updated
            $insertedRow =  CsvData::where('SSN',$ssn)->first();
            if($insertedRow->wasChanged()){ // if it was changed then this is an updated row
                $rowsCount = $rowsCount - 1;
            }
        }
        event(new CsvDataSaved($userId,$rowsCount));
        return response()->json(['message' => 'rows are saved']);
    }
}
public function retrieveData($id){
    $user = User::find($id);
    $userData = $user->csvData;
    return response()->json(['UserData' =>  $userData]);
}
}
