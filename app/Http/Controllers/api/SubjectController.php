<?php

namespace App\Http\Controllers\api;



use App\Http\Resources\En\SubjectResource as En_SubjectResource ;
use App\Http\Resources\Ar\SubjectResource as Ar_SubjectResource  ;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Config;
use Illuminate\Support\Facades\Validator;
use App\Subject;

class SubjectController extends Controller
{
    function index(Request $request)
    {
        if ($request->input('lang') == 'en') {
            $subjects = En_SubjectResource::collection(Subject::get());
            return response()->json(compact(['subjects']), 200);
        }
        elseif ($request->input('lang') == 'ar') {
            $subjects = Ar_SubjectResource::collection(Subject::get());
            return response()->json(compact(['subjects']), 200);
        }
        else {
            return response()->json("please enter language you want", 200);
        }
    }
}
