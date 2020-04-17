<?php

namespace App\Http\Controllers\api;

use App\Quiz;

use App\User;
use App\Http\Resources\Streamer\QuizResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;
use Config;
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
        if($user->role!=1){
            return response()->json('sorry this user role is not As Streamer',402);
        }
        $paginate=$request->input('P');
         if($paginate==null){
             $paginate=10;
         };
//        dd($user->id);
       $quiz=Quiz::where('streamer_id',$user->role_id)->paginate($paginate);
       return QuizResource::collection($quiz);
    }

}
