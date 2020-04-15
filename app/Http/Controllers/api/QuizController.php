<?php

namespace App\Http\Controllers\api;

use App\Quiz;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class QuizController extends Controller
{
    /**
     * @OA\Get(
     *     operationId="Quiz",
     *     path="/api/quiz",
     *     tags={"quiz Pages"},
     *     security={{"bearerAuth":{}}},
     * @OA\Parameter(
     *         name="lang",
     *         in="query",
     *         required=true,
     *         description="Lang",
     *         @OA\Schema(
     *              type="string",
     *              example="ar",
     *         )
     *      ),
     * @OA\Parameter(
     *      name="query_search",
     *      description="search in the clinics",
     *      required=false,
     *      in="query",
     *      @OA\Schema(
     *          type="integer"
     *      )
     *   ),
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
    }


}
