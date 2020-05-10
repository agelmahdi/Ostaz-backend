<?php

namespace App\Http\Controllers\api;

use App\Answer;
use App\Group;
use App\Http\Resources\Streamer\AnswerResource;
use App\Http\Resources\Streamer\LessonResource;
use App\Http\Resources\Streamer\QuestionResource;
use App\Lesson;
use App\Quiz;
use App\Question;
use App\User;
use App\Http\Resources\Streamer\QuizResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Config;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
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

    function lesson($group, Request $request)
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
        $group = Group::where('streamer_id', $user->role_id)->where('slug', $group)->first();
        if ($group == null) {
            return response()->json(['sorry your data not equal our system'], 400);
        }
        $lesson = Lesson::where('group_id', $group->id)->paginate($paginate);

        return LessonResource::collection($lesson);
    }
    function createLesson($group, Request $request)
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
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $group = Group::where('streamer_id', $user->role_id)->where('slug', $group)->first();
        if ($group == null) {
            return response()->json(['sorry your Group data not equal our system'], 400);
        }

        $slug = $this->generateRandomString(10);
        $lesson = Lesson::create([
            'title' => $request->get('title'),
            'slug' => $slug,
            'description' => $request->get('description'),
            'start' => $request->get('start'),
            'end' => $request->get('end'),
            'group_id' => $group->id,
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
    function Detail_lesson($lesson)
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
        $lesson = Lesson::where('slug', $lesson)->with('group')->first();
        if ($lesson == null) {
            return response()->json(['sorry your lesson slug not equal our system'], 400);
        }
        $group = Group::where('streamer_id', $user->role_id)->where('id', $lesson->group->id)->first();
        if ($group == null) {
            return response()->json(['sorry your Group not equal our system'], 400);
        }
        $lesson = [
            "title" => $lesson->title,
            "slug" => $lesson->slug,
            "description" => $lesson->description,
            "start" => $lesson->start,
            "end" => $lesson->end,
            "created_at" => $lesson->created_at,
            "quiz"=>[
                "title" => $lesson->group->title,
                "slug" => $lesson->group->slug,
                "description" => $lesson->group->description,
                "start" => $lesson->group->start,
                "end" => $lesson->group->end,
                "academic_year"=>$lesson->group->academic_year->title_en,
                "subject"=>$lesson->group->subject->title_en,
                "lesson"=>$lesson->group->lessons()->count(),
            ],
        ];

        return response()->json(compact('lesson'), 200);
    }
    function Update_lesson($lesson,Request $request)
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

        $lesson = Lesson::where('slug', $lesson)->with('group')->first();
        if ($lesson == null) {
            return response()->json(['sorry your Lesson slug not equal our system'], 400);
        }
        $group = Group::where('streamer_id', $user->role_id)->where('id', $lesson->group->id)->first();
        if ($group == null) {
            return response()->json(['sorry your Group not equal our system'], 400);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $lesson->update([
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'start' => $request->get('start'),
            'end' => $request->get('end'),
            'academic_year_id' => $group->id,
        ]);
        $lesson->save();

        return response()->json(['success'], 200);

    }
    function Delete_lesson($lesson)
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
        $lesson = Lesson::where('slug', $lesson)->first();
        if ($lesson == null) {
            return response()->json(['sorry your Lesson slug not equal our system'], 400);
        }
        $group = Group::where('streamer_id', $user->role_id)->where('id', $lesson->group->id)->first();
        if ($group == null) {
            return response()->json(['sorry your Group not equal our system'], 400);
        }
        $lesson->delete();
        return response()->json(['success'], 200);

    }
}
