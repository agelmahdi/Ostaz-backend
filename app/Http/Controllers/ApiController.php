<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title=APP_SWAGGER_Title,
 *         description=APP_SWAGGER_Description,
 *     ),
 *    @OA\Server(
 *         description=APP_SWAGGER_Title,
 *         url=L5_SWAGGER_CONST_HOST
 *     )
 * ),
 ** @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      in="header",
 *      name="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 * ),
 *
 **/


/**
 * @OA\Get(
 *     path="/api/resource.json",
 *     @OA\Response(response="200", description="An example resource")
 * )
 */
class ApiController extends Controller
{

}
