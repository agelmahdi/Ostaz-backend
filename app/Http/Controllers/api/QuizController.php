<?php

namespace App\Http\Controllers\api;

use App\Quiz;

use App\User;
use App\Http\Resources\Streamer\QuizResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Config;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
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

    /**
     * @OA\Get(
     *     operationId="Quiz",
     *     path="/api/streamer/quiz",
     *     tags={"quiz Pages"},
     *     security={{"bearerAuth":{}}},
     * @OA\Parameter(
     *         name="P",
     *         in="query",
     *         required=true,
     *         description="Paginate",
     *         @OA\Schema(
     *              type="integer",
     *              example="10",
     *         )
     *      ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=true,
     *         description="Page Number",
     *         @OA\Schema(
     *              type="integer",
     *              example="1",
     *         )
     *      ),
     *     @OA\Response(
     *     response="200",
     *      description="For Home Data as ['quizes']")
     * )
     */
    function quizes(Request $request)
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
        $quiz = Quiz::where('streamer_id', $user->role_id)->paginate($paginate);
        return QuizResource::collection($quiz);
    }

    /**
     * @OA\Post(
     *   path="/api/streamer/create_quiz",
     *   summary="Add New Quiz",
     *   tags={"quiz Pages"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"title","time","email", "lang","questions_number"},
     *     @OA\Property(
     *         property="title",
     *         type="string",
     *         example="First Exam",
     *         description="required|string|max:255"
     *       ),
     *     @OA\Property(
     *         property="time",
     *         type="string",
     *         example=10,
     *         description="required|integer"
     *       ),
     *     @OA\Property(
     *         property="lang",
     *         type="string",
     *         example="ar",
     *         description="required|string|max:255(ar-en)"
     *       ),
     *     @OA\Property(
     *         property="questions_number",
     *         type="string",
     *         example=10,
     *         description="required|integer"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="{Success}",
     *         type="string",
     *         description="Data Created SuccessFully "
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=400,
     *     description="Unauthorized",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="error:These credentials do not match our records.",
     *         type="string",
     *         description="These credentials do not match our records."
     *       )
     *     )
     *    )
     *   )
     * )
     */
    function createQuiz(Request $request)
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
            'time' => 'required|integer',
            'lang' => 'required|string|max:255',
            'questions_number' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $slug = $this->generateRandomString(10);
        Quiz::create([
            'title' => $request->get('title'),
            'slug' => $slug,
            'time' => $request->get('time'),
            'lang' => $request->get('lang'),
            'questions_number' => $request->get('questions_number'),
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

    /**
     * @OA\Get(
     *     operationId="Quiz",
     *     path="/api/streamer/quiz/{slug}",
     *     tags={"quiz Pages"},
     *     security={{"bearerAuth":{}}},
     *  @OA\Parameter(
     *      name="slug",
     *      description="Quiz Slug",
     *      required=true,
     *      in="path",
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *     @OA\Response(
     *     response="200",
     *      description="For Home Data as ['quizes']")
     * )
     */
    function Detail_quiz($quiz)
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
        $quiz = Quiz::where('streamer_id', $user->role_id)->where('slug', $quiz)->first();
        if ($quiz == null) {
            return response()->json(['sorry your data not equal our system'], 400);
        }
        $quiz = [
            "title" => $quiz->title,
            "time" => $quiz->time,
            "lang" => $quiz->lang,
            "questions_limit" => $quiz->questions_number,
            "question_number" => $quiz->questions()->count(),
        ];

        return response()->json(compact('quiz'), 200);
    }
}
