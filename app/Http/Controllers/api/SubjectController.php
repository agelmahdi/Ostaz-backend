<?php

namespace App\Http\Controllers\api;


use App\AcademicYear;
use App\Http\Resources\En\SubjectResource as En_SubjectResource;
use App\Http\Resources\Ar\SubjectResource as Ar_SubjectResource;
use App\Streamer;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Config;
use Illuminate\Support\Facades\Validator;
use App\Subject;

class SubjectController extends Controller
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
            $subjects = En_SubjectResource::collection(Subject::get());
            return response()->json(compact(['subjects']), 200);
        } elseif ($request->input('lang') == 'ar') {
            $subjects = Ar_SubjectResource::collection(Subject::get());
            return response()->json(compact(['subjects']), 200);
        } else {
            return response()->json("please enter language you want", 200);
        }
    }

    function store_subjects_streamer(Request $request)
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
            'subjects' => 'required|max:500',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $subjects = json_decode(str_replace("'", '"', $request->get('subjects')), true);
        if ($subjects == null) {
            return response()->json(['sorry your subjects not write Correctly'], 400);
        }
        if (count($subjects) == 0) {
            return response()->json(['The Array must contain data'], 400);
        }
        $count = 0;
        $subjects_arr = [];
        foreach ($subjects as $subject) {

            $subject = Subject::where(function ($query) use ($subject) {
                $query->where('slug_ar', $subject);
                $query->orwhere('slug_en', $subject);
            })->first();
            if ($subject != null) {
                $subjects_arr[$count] = $subject->id;
                $count++;
            }
        }
        $streamer = Streamer::where('id', $user->role_id)->first();
        $streamer->Subjects()->sync($subjects_arr);
        return response()->json(['Add successfully'], 200);
    }

    function get_subjects_streamer(Request $request)
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

        $streamer = Streamer::where('id', $user->role_id)->with('Subjects')->first();

        if ($request->input('lang') == 'en') {
            $subjects = En_SubjectResource::collection($streamer->Subjects);
            return response()->json(compact(['subjects']), 200);
        } elseif ($request->input('lang') == 'ar') {
            $subjects = Ar_SubjectResource::collection($streamer->Subjects);
            return response()->json(compact(['subjects']), 200);
        } else {
            return response()->json("please enter language you want", 200);
        }

    }
}
