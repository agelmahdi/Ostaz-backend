<?php

namespace App\Http\Controllers\api;


use App\Governorate;
use App\Http\Resources\Ar\AcademicYearResource as Ar_AcademicYearResource;
use App\Http\Resources\Ar\GovResource as Ar_GovResource;
use App\Http\Resources\Ar\SubjectResource as Ar_SubjectResource;
use App\Http\Resources\En\AcademicYearResource as En_AcademicYearResource;
use App\Http\Resources\En\GovResource as En_GovResource;
use App\Http\Resources\En\SubjectResource as En_SubjectResource;
use App\Streamer;
use App\Subject;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Config;
use Illuminate\Support\Facades\Validator;
use App\AcademicYear;

class AcademicYearController extends Controller
{
    function __construct()
    {
        // We set the guard api as default driver
        auth()->setDefaultDriver('api');
        Config::set('jwt.user', User::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model' => User::class,
        ]]);
    }

    function index(Request $request)
    {
        if ($request->input('lang') == 'en') {
            $academicYears = En_AcademicYearResource::collection(AcademicYear::get());
            return response()->json(compact(['academicYears']), 200);
        } elseif ($request->input('lang') == 'ar') {
            $academicYears = Ar_AcademicYearResource::collection(AcademicYear::get());
            return response()->json(compact(['academicYears']), 200);
        } else {
            return response()->json("please enter language you want", 200);
        }
    }

    function store_academic_years_streamer(Request $request)
    {

        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        if ($user->role != 1) {
            return response()->json('sorry this user role is not As Streamer', 402);
        }
        $validator = Validator::make($request->all(), [
            'academic_years' => 'required|max:500',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $academic_years = json_decode(str_replace("'", '"', $request->get('academic_years')), true);
        if ($academic_years == null) {
            return response()->json(['sorry your academic_years not write Correctly'], 400);
        }
        if (count($academic_years) == 0) {
            return response()->json(['The Array must contain data'], 400);
        }
        $count = 0;
        $academic_arr = [];
        foreach ($academic_years as $academic_year) {
            $academic = AcademicYear::where(function ($query) use ($academic_year) {
                $query->where('slug_ar', $academic_year);
                $query->orwhere('slug_en', $academic_year);
            })->first();
            if ($academic != null) {
                $academic_arr[$count] = $academic->id;
                $count++;
            }
        }
        $streamer = Streamer::where('id', $user->role_id)->first();
        $streamer->AcademicYears()->sync($academic_arr);
        return response()->json(['Add successfully'], 200);
    }

    function get_academic_years_streamer(Request $request)
    {

        try {

            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        if ($user->role != 1) {
            return response()->json('sorry this user role is not As Streamer', 402);
        }

        $streamer = Streamer::where('id', $user->role_id)->with('AcademicYears')->first();

        if ($request->input('lang') == 'en') {
            $academicYears = En_AcademicYearResource::collection($streamer->AcademicYears);
            return response()->json(compact(['academicYears']), 200);
        } elseif ($request->input('lang') == 'ar') {
            $academicYears = Ar_AcademicYearResource::collection($streamer->AcademicYears);
            return response()->json(compact(['academicYears']), 200);
        } else {
            return response()->json("please enter language you want", 200);
        }

    }
    function get_all_data(Request $request)
    {

        if ($request->input('lang') == 'en') {
            $academicYears = En_AcademicYearResource::collection(AcademicYear::get());
            $governorates=En_GovResource::collection(Governorate::with('cities')->get());
            $subjects = En_SubjectResource::collection(Subject::get());
            return response()->json(compact(['academicYears','subjects','governorates']), 200);
        } elseif ($request->input('lang') == 'ar') {
            $academicYears = Ar_AcademicYearResource::collection(AcademicYear::get());
            $governorates=Ar_GovResource::collection(Governorate::with('cities')->get());
            $subjects = Ar_SubjectResource::collection(Subject::get());
            return response()->json(compact(['academicYears','subjects','governorates']), 200);
        } else {
            return response()->json("please enter language you want", 200);
        }

    }
}
