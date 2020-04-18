<?php

namespace App\Http\Controllers\api;

use App\Answer;
use App\Http\Resources\Streamer\AnswerResource;
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

    function question($quiz, Request $request)
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
    function createQuestion($quiz, Request $request)
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
            'answers' => 'required|max:500',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $quiz = Quiz::where('streamer_id', $user->role_id)->where('slug', $quiz)->first();
        if ($quiz == null) {
            return response()->json(['sorry your data not equal our system'], 400);
        }
        $answers=json_decode(str_replace("'",'"',$request->get('answers')), true);
        if($answers == null){
            return response()->json(['sorry your Answers not write Correctly'], 400);
        }
        $slug = $this->generateRandomString(10);
        $question = Question::create([
            'title' => $request->get('title'),
            'slug' => $slug,
            'quiz_id' => $quiz->id,
        ]);
        foreach ($answers as $answer){
                Answer::create([
                    'title' => $answer['title'],
                    'slug' => $this->generateRandomString(10),
                    'right' => $answer['type'],
                    'question_id' => $question->id,
                ]);
            }

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
    function Detail_question($quiz,$question)
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
        $quiz = Quiz::where('streamer_id', $user->role_id)->with('questions')->where('slug', $quiz)->first();
        if ($quiz == null) {
            return response()->json(['sorry your Quiz slug not equal our system'], 400);
        }
        $question = Question::where('quiz_id', $quiz->id)->where('slug', $question)->with('quiz')->with('answers')->first();
        if ($question == null) {
            return response()->json(['sorry your question slug not equal our system'], 400);
        }
        $question = [
            "title" => $question->title,
            "slug" => $question->slug,
            "Answer_number"=>$question->answers()->count(),
            "created_at" => $question->created_at,
            "quiz"=>[
                "title" => $question->quiz->title,
                "slug" => $question->quiz->slug,
                "question_number"=>$question->quiz->questions()->count(),
                "created_at" => $question->quiz->created_at,
            ],
            "answers"=>AnswerResource::collection($question->answers)
        ];

        return response()->json(compact('question'), 200);
    }
    function Update_question($quiz,Request $request)
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
        $quiz = Quiz::where('streamer_id', $user->role_id)->with('questions')->where('slug', $quiz)->first();
        if ($quiz == null) {
            return response()->json(['sorry your data not equal our system'], 400);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'time' => 'required|integer',
            'lang' => 'required|string|max:255',
            'questions_number' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $quiz->update([
            'title' => $request->get('title'),
            'time' => $request->get('time'),
            'lang' => $request->get('lang'),
            'questions_number' => $request->get('questions_number')
        ]);
        $quiz->save();
        return response()->json(['success'], 200);

    }
    function Delete_question($quiz)
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
        $quiz = Quiz::where('streamer_id', $user->role_id)->with('questions')->where('slug', $quiz)->first();
        if ($quiz == null) {
            return response()->json(['sorry your data not equal our system'], 400);
        }
        $quiz->delete();
        return response()->json(['success'], 200);

    }
}
