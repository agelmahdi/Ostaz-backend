<?php

namespace App\Http\Controllers\api;


use App\Http\Resources\Ar\AcademicYearResource as Ar_AcademicYearResource;
use App\Http\Resources\En\AcademicYearResource as En_AcademicYearResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Config;
use Illuminate\Support\Facades\Validator;
use App\AcademicYear;

class AcademicYearController extends Controller
{

    function index(Request $request)
    {
        if ($request->input('lang') == 'en') {
            $academicYears = En_AcademicYearResource::collection(AcademicYear::get());
            return response()->json(compact(['academicYears']), 200);
        }
        elseif ($request->input('lang') == 'ar') {
            $academicYears = Ar_AcademicYearResource::collection(AcademicYear::get());
            return response()->json(compact(['academicYears']), 200);
        }
        else {
            return response()->json("please enter language you want", 200);
        }
    }

}
