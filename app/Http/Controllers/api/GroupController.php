<?php

namespace App\Http\Controllers\api;

use App\AcademicYear;
use App\Group;
use App\Http\Resources\Streamer\QuestionResource;
use App\Quiz;
use App\Subject;
use App\User;
use App\Http\Resources\Streamer\GroupResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Config;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
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

    function groups(Request $request)
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
        $paginate = $request->input('P');
        if ($paginate == null) {
            $paginate = 10;
        };
        $group = Group::where('streamer_id', $user->role_id)->paginate($paginate);
        return GroupResource::collection($group);
    }
    function createGroup(Request $request)
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
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
            'academic_year' => 'required',
            'subject' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $slug=$request->get('academic_year');
        $academic_year = AcademicYear::where(function ($query) use ($slug) {
            $query->where('slug_ar', $slug);
            $query->orwhere('slug_en', $slug);
        })->first();
        if ($academic_year == null) {
            return response()->json(['sorry your Academic Year data not equal our system'], 400);
        }
        $slug=$request->get('subject');
        $subject = Subject::where(function ($query) use ($slug) {
            $query->where('slug_ar', $slug);
            $query->orwhere('slug_en', $slug);
        })->first();
        if ($subject == null) {
            return response()->json(['sorry your Subject data not equal our system'], 400);
        }
        $slug = $this->generateRandomString(10);
        Group::create([
            'title' => $request->get('title'),
            'slug' => $slug,
            'description' => $request->get('description'),
            'start' => $request->get('start'),
            'end' => $request->get('end'),
            'academic_year_id' => $academic_year->id,
            'subject_id' => $subject->id,
            'streamer_id' => $user->role_id,
        ]);
        return response()->json(['success'], 200);
    }
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function Detail_group($group)
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
        $group = Group::where('streamer_id', $user->role_id)->where('slug', $group)->first();
        if ($group == null) {
            return response()->json(['sorry your data not equal our system'], 400);
        }
        $group = [
            "title" => $group->title,
            "slug" => $group->slug,
            "description" => $group->description,
            "start" => $group->start,
            "end" => $group->end,
            "academic_year"=>$group->academic_year->title_en,
            "subject"=>$group->subject->title_en,
            "lesson"=>$group->lessons->count(),
            "lesson"=>$group->lessons,
            "created_at" => $group->created_at,
//            "questions" =>QuestionResource::collection($group->questions),
        ];

        return response()->json(compact('group'), 200);
    }
    function Update_group($group,Request $request)
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
        $group = Group::where('streamer_id', $user->role_id)->where('slug', $group)->first();
        if ($group == null) {
            return response()->json(['sorry your data not equal our system'], 400);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
            'academic_year' => 'required',
            'subject' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $slug=$request->get('academic_year');
        $academic_year = AcademicYear::where(function ($query) use ($slug) {
            $query->where('slug_ar', $slug);
            $query->orwhere('slug_en', $slug);
        })->first();
        if ($academic_year == null) {
            return response()->json(['sorry your Academic Year data not equal our system'], 400);
        }
        $slug=$request->get('subject');
        $subject = Subject::where(function ($query) use ($slug) {
            $query->where('slug_ar', $slug);
            $query->orwhere('slug_en', $slug);
        })->first();
        if ($subject == null) {
            return response()->json(['sorry your Subject data not equal our system'], 400);
        }
        $group->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'start' => $request->get('start'),
            'end' => $request->get('end'),
            'academic_year_id' => $academic_year->id,
            'subject_id' => $subject->id,
        ]);
        $group->save();
        return response()->json(['success'], 200);

    }
    function Delete_group($group)
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
        $group = Group::where('streamer_id', $user->role_id)->where('slug', $group)->first();
        if ($group == null) {
            return response()->json(['sorry your data not equal our system'], 400);
        }
        $group->delete();
        return response()->json(['success'], 200);

    }
}
