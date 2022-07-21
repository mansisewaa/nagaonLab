<?php

namespace App\Helper;

use App\Models\AgeGroup;
use App\Models\EventLocation;
use Illuminate\Http\Request;
use App\Models\TestTransaction;
use App\Models\PatientDetails;
class CommonHelper
{


    public static function getTestCount($created_date,$to_date,$test_name){
        return TestTransaction::whereBetween('created_at', [$created_date, $to_date])->where('inv_name', '=', $test_name)->count();
    }
    public static function getPatientCount($created_date,$to_date){
        return PatientDetails::whereBetween('created_at', [$created_date, $to_date])->count();
    }
    // public static function isNonCompetitive($status){
    //     return $status == self::NON_COMPETIVIVE;
    // }


    public static function getEventLocationId(){
        return request("location_string");
    }
}
