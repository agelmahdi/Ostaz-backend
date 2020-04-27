<?php

namespace App\Http\Controllers\api;


use App\AcademicYear;
use App\Governorate;
use App\Http\Resources\En\GovResource as En_GovResource;
use App\Http\Resources\Ar\GovResource as Ar_GovResource;
use App\Streamer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Config;
use Illuminate\Support\Facades\Validator;
use App\Subject;

class GovernorateController extends Controller
{

    function index(Request $request)

    {


        if ($request->input('lang') == 'en') {
            $governorates=En_GovResource::collection(Governorate::with('cities')->get());
            return response()->json(compact(['governorates']), 200);
        } elseif ($request->input('lang') == 'ar') {
            $governorates=Ar_GovResource::collection(Governorate::with('cities')->get());
            return response()->json(compact(['governorates']), 200);
        } else {
            return response()->json("please enter language you want", 200);
        }
    }


}
