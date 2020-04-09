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
 *         url="http://127.0.0.1:8000"
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


class ApiController extends Controller
{

}
