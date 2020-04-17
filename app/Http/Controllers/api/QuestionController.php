<?php

namespace App\Http\Controllers\api;

use App\Http\Resources\Streamer\QuestionResource;
use App\Quiz;
use App\Question;
use App\User;
use App\Http\Resources\Streamer\QuizResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Config;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
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

    function question($quiz,Request $request)
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
        $quiz = Quiz::where('streamer_id', $user->role_id)->where('slug', $quiz)->first();
        if ($quiz == null) {
            return response()->json(['sorry your data not equal our system'], 400);
        }
        $qusestion = Question::where('quiz_id', $quiz->id)->paginate($paginate);
        return QuestionResource::collection($qusestion);
    }
    function createQuestion($quiz,Request $request)
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
            'title' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $quiz = Quiz::where('streamer_id', $user->role_id)->where('slug', $quiz)->first();
        if ($quiz == null) {
            return response()->json(['sorry your data not equal our system'], 400);
        }
        $slug = $this->generateRandomString(10);
        Question::create([
            'title' => $request->get('title'),
            'slug' => $slug,
            'quiz_id' =>$quiz->id,
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
}
