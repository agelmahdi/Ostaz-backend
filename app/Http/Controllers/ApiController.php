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
//===========================Start=Auth=============================================
/**
 * @OA\Post(
 *   path="/api/login",
 *   summary="User Login",
 *   tags={"Authorization"},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       required={"email", "password"},
 *       @OA\Property(
 *         property="email",
 *         type="string",
 *         example="streamer@streamer.com",
 *         description="required|string|email|max:255"
 *       ),
 *       @OA\Property(
 *         property="password",
 *         type="string",
 *         example="123123123",
 *         description="required|string|min:6"
 *       )
 *     )
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Success",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="token:",
 *         type="string",
 *         description="The Token"
 *       )
 *     )
 *   ),
 *   @OA\Response(
 *     response=400,
 *     description="invalid_credentials",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="error:These credentials do not match our records.",
 *         type="string",
 *         description="These credentials do not match our records."
 *       )
 *     )
 *    ),
 *   @OA\Response(
 *     response=401,
 *     description="Validator",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="Validator.",
 *         type="string",
 *         description="Validator"
 *       )
 *     )
 *    )
 *   )
 * )
 */
/**
 * @OA\Get(
 *   path="/api/me",
 *   summary="User Data",
 *   tags={"Authorization"},
 *   security={{"bearerAuth":{}}},
 *   @OA\Response(
 *     response=201,
 *     description="Success",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="{user{name,email,updated_at,created_at,id},token}",
 *         type="string",
 *         description="The Token"
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
//===========================End=Auth=============================================
//============================Start==Follower=============================================
//===========================Start=Auth=============================================
        /**
     * @OA\Post(
     *   path="/api/follower/register",
     *   summary="User Registration",
     *   tags={"Follower Authorization"},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name","phone","email", "password","password_confirmation"},
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         example="user",
     *         description="required|string|max:255"
     *       ),
     *      @OA\Property(
     *         property="phone",
     *         type="integer",
     *         example="1234567",
     *         description="['required', 'unique:followers']"
     *       ),
     *       @OA\Property(
     *         property="address",
     *         type="string",
     *         example="Andalusia Group, 9 Mohamed Baidar St. from ElNasr St., New Maadi, Cairo, Egypt.",
     *         description="string|max:255"
     *       ),
     *     @OA\Property(
     *         property="gender",
     *         type="string",
     *         example="0",
     *         description="0= Male ,1=Female"
     *       ),
     *     @OA\Property(
     *         property="birthday",
     *         type="string",
     *         example="15/1/1994",
     *         description="string|max:255"
     *       ),
     *     @OA\Property(
     *         property="image",
     *         type="file",
     *         example="File Image",
     *         description="image|mimes:jpeg,png,jpg,gif,svg|max:1024"
     *       ),
     *       @OA\Property(
     *         property="email",
     *         type="string",
     *         example="follower@follower.com",
     *         description="required|string|email|max:255|unique:users"
     *       ),
     *       @OA\Property(
     *         property="password",
     *         type="string",
     *         example="123123123",
     *         description="required|string|min:6|confirmed"
     *       ),
     *     @OA\Property(
     *         property="password_confirmation",
     *         type="string",
     *         example="123123123",
     *         description="Same As Password"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="{user{name,email,updated_at,created_at,id},token}",
     *         type="string",
     *         description="The Token"
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
        /**
     * @OA\Put(
     *   path="/api/follower/update-profile-password",
     *   summary="User Update Profile Password",
     *   tags={"Follower Authorization"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"current_password","new_password","new_password_confirmation"},
     *     @OA\Property(
     *         property="current_password",
     *         type="string",
     *         example="123123",
     *         description="required|string|max:255"
     *       ),
     *        @OA\Property(
     *         property="new_password",
     *         type="string",
     *         example="12341234",
     *         description="required|string|max:255"
     *       ),
     *     @OA\Property(
     *         property="new_password_confirmation",
     *         type="string",
     *         example="12341234",
     *         description="Same As Password"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="{user{data}",
     *         type="string",
     *         description="User"
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
        /**
     * @OA\Put(
     *   path="/api/follower/update-profile",
     *   summary="User Update Profile Data",
     *   tags={"Follower Authorization"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name","phone","email"},
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         example="user",
     *         description="required|string|max:255"
     *       ),
     *      @OA\Property(
     *         property="phone",
     *         type="integer",
     *         example="1234567",
     *         description="['required','regex:/^(5|0|3|6|4|9|1|8|7)([0-9]{7})$/']"
     *       ),
     *       @OA\Property(
     *         property="address",
     *         type="string",
     *         example="Andalusia Group, 9 Mohamed Baidar St. from ElNasr St., New Maadi, Cairo, Egypt.",
     *         description="string|max:255"
     *       ),
     *     @OA\Property(
     *         property="gender",
     *         type="string",
     *         example=0,
     *         description="string|max:20"
     *       ),
     *     @OA\Property(
     *         property="birthday",
     *         type="string",
     *         example="15/2/1994",
     *         description="string|max:20"
     *       ),
     *       @OA\Property(
     *         property="email",
     *         type="string",
     *         example="user@user.com",
     *         description="required|string|email|max:255|unique:users"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="{user{data}",
     *         type="string",
     *         description="User"
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
        /**
     * @OA\Post(
     *   path="/api/follower/update-profile-image",
     *   summary="User Update Profile Image",
     *   tags={"Follower Authorization"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"Image"},
     *     @OA\Property(
     *         property="image",
     *         type="file",
     *         example="File Image",
     *         description="required|image|mimes:jpeg,png,jpg,gif,svg|max:1024"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="{user{data}",
     *         type="string",
     *         description="User"
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
//===========================End=Auth=============================================
//============================End==Follower===============================================
//============================Start==Streamer=============================================
//===========================Start=Auth=============================================
        /**
     * @OA\Post(
     *   path="/api/streamer/register",
     *   summary="User Registration",
     *   tags={"Streamer Authorization"},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name","phone","email", "password","password_confirmation"},
     *     @OA\Property(
     *         property="name_ar",
     *         type="string",
     *         example="أحمد توفيق",
     *         description="required|string|max:255"
     *       ),
     *     @OA\Property(
     *         property="name_en",
     *         type="string",
     *         example="Ahmed Tawfek",
     *         description="required|string|max:255"
     *       ),
     *     @OA\Property(
     *         property="slug_ar",
     *         type="string",
     *         example="أحمد_توفيق",
     *         description="required|string|max:255"
     *       ),
     *     @OA\Property(
     *         property="slug_en",
     *         type="string",
     *         example="ahmed_tawfek",
     *         description="required|string|max:255"
     *       ),
     *      @OA\Property(
     *         property="phone",
     *         type="integer",
     *         example="1234567",
     *         description="['required', 'unique:streamers']"
     *       ),
     *       @OA\Property(
     *         property="address_ar",
     *         type="string",
     *         example="Andalusia Group, 9 Mohamed Baidar St. from ElNasr St., New Maadi, Cairo, Egypt.",
     *         description="string|max:255"
     *       ),
     *       @OA\Property(
     *         property="address_en",
     *         type="string",
     *         example="Andalusia Group, 9 Mohamed Baidar St. from ElNasr St., New Maadi, Cairo, Egypt.",
     *         description="string|max:255"
     *       ),
     *     @OA\Property(
     *         property="gender",
     *         type="string",
     *         example="0",
     *         description="0= Male ,1=Female"
     *       ),
     *       @OA\Property(
     *         property="email",
     *         type="string",
     *         example="streamer@streamer.com",
     *         description="required|string|email|max:255|unique:streamers"
     *       ),
     *       @OA\Property(
     *         property="password",
     *         type="string",
     *         example="123123123",
     *         description="required|string|min:6|confirmed"
     *       ),
     *     @OA\Property(
     *         property="password_confirmation",
     *         type="string",
     *         example="123123123",
     *         description="Same As Password"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="{user{name,email,updated_at,created_at,id},token}",
     *         type="string",
     *         description="The Token"
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
        /**
     * @OA\Put(
     *   path="/api/streamer/update-profile-password",
     *   summary="User Update Profile Password",
     *   tags={"Streamer Authorization"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"current_password","new_password","new_password_confirmation"},
     *     @OA\Property(
     *         property="current_password",
     *         type="string",
     *         example="123123",
     *         description="required|string|max:255"
     *       ),
     *        @OA\Property(
     *         property="new_password",
     *         type="string",
     *         example="12341234",
     *         description="required|string|max:255"
     *       ),
     *     @OA\Property(
     *         property="new_password_confirmation",
     *         type="string",
     *         example="12341234",
     *         description="Same As Password"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="{user{data}",
     *         type="string",
     *         description="User"
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
        /**
     * @OA\Put(
     *   path="/api/streamer/update-profile",
     *   summary="User Update Profile Data",
     *   tags={"Streamer Authorization"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"name","phone","email"},
     *     @OA\Property(
     *         property="name",
     *         type="string",
     *         example="user",
     *         description="required|string|max:255"
     *       ),
     *      @OA\Property(
     *         property="phone",
     *         type="integer",
     *         example="1234567",
     *         description="['required','regex:/^(5|0|3|6|4|9|1|8|7)([0-9]{7})$/']"
     *       ),
     *       @OA\Property(
     *         property="address",
     *         type="string",
     *         example="Andalusia Group, 9 Mohamed Baidar St. from ElNasr St., New Maadi, Cairo, Egypt.",
     *         description="string|max:255"
     *       ),
     *     @OA\Property(
     *         property="gender",
     *         type="string",
     *         example="Male",
     *         description="string|max:20"
     *       ),
     *     @OA\Property(
     *         property="birthday",
     *         type="string",
     *         example="15/2/1994",
     *         description="string|max:20"
     *       ),
     *       @OA\Property(
     *         property="email",
     *         type="string",
     *         example="user@user.com",
     *         description="required|string|email|max:255|unique:users"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="{user{data}",
     *         type="string",
     *         description="User"
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
        /**
     * @OA\Post(
     *   path="/api/streamer/update-profile-image",
     *   summary="User Update Profile Image",
     *   tags={"Streamer Authorization"},
     *   security={{"bearerAuth":{}}},
     *   @OA\RequestBody(
     *     required=true,
     *     @OA\JsonContent(
     *       type="object",
     *       required={"Image"},
     *     @OA\Property(
     *         property="image",
     *         type="file",
     *         example="File Image",
     *         description="required|image|mimes:jpeg,png,jpg,gif,svg|max:1024"
     *       )
     *     )
     *   ),
     *   @OA\Response(
     *     response=201,
     *     description="Success",
     *     @OA\JsonContent(
     *       type="object",
     *       @OA\Property(
     *         property="{user{data}",
     *         type="string",
     *         description="User"
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
//===========================End=Auth=============================================
//===========================Start=Academic Years===========================================
/**
 * @OA\Get(
 *     operationId=" All Academic Years",
 *     path="/api/academicYears",
 *     tags={"Academic Years"},
 *     @OA\Parameter(
 *         name="lang",
 *         in="query",
 *         required=true,
 *         description="Lang",
 *         @OA\Schema(
 *              type="string",
 *              example="ar",
 *         )
 *      ),
 *     @OA\Response(
 *     response="200",
 *      description="For Home Data as ['posts']")
 * )
 */
/**
 * @OA\Post(
 *     operationId=" Create For Streamer Academic Years",
 *     path="/api/streamer/create_academic",
 *     tags={"Academic Years"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       required={"academic_years"},
 *     @OA\Property(
 *         property="academic_years",
 *         type="string",
 *         example="['الصف-الاول-الابتدائي','الصف-الثانى-الابتدائي','الصف-الثالث-الاعدادي','first-grade-secondary']",
 *         description="required|string|max:255"
 *       )
 *     )
 *   ),
 *     @OA\Response(
 *     response="200",
 *      description="For Home Data as ['posts']")
 * )
 */
/**
 * @OA\Get(
 *     operationId="Academic Years of streamer",
 *     path="/api/streamer/academicYears",
 *     tags={"Academic Years"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="lang",
 *         in="query",
 *         required=true,
 *         description="Lang",
 *         @OA\Schema(
 *              type="string",
 *              example="ar",
 *         )
 *      ),
 *     @OA\Response(
 *     response="200",
 *      description="For Home Data as ['Academic Years']")
 * )
 */
//===========================End=Academic Years=============================================
//===========================Start=Subjects===========================================
/**
 * @OA\Get(
 *     operationId=" All Subjects",
 *     path="/api/subjects",
 *     tags={"Subjects"},
 *     @OA\Parameter(
 *         name="lang",
 *         in="query",
 *         required=true,
 *         description="Lang",
 *         @OA\Schema(
 *              type="string",
 *              example="ar",
 *         )
 *      ),
 *     @OA\Response(
 *     response="200",
 *      description="For Home Data as ['posts']")
 * )
 */
/**
 * @OA\Post(
 *     operationId=" Create For Streamer Subjects",
 *     path="/api/streamer/create_subjects",
 *     tags={"Subjects"},
 *     security={{"bearerAuth":{}}},
 *     @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       required={"subjects"},
 *     @OA\Property(
 *         property="subjects",
 *         type="string",
 *         example="['كيمياء']",
 *         description="required|string|max:255"
 *       )
 *     )
 *   ),
 *     @OA\Response(
 *     response="200",
 *      description="For Home Data as ['subjects']")
 * )
 */
/**
 * @OA\Get(
 *     operationId="Subjects of streamer",
 *     path="/api/streamer/subjects",
 *     tags={"Subjects"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *         name="lang",
 *         in="query",
 *         required=true,
 *         description="Lang",
 *         @OA\Schema(
 *              type="string",
 *              example="ar",
 *         )
 *      ),
 *     @OA\Response(
 *     response="200",
 *      description="For Home Data as ['subjects']")
 * )
 */
//===========================End=Subjects=============================================
//===========================Start=Group=============================================
/**
 * @OA\Get(
 *     operationId="groups",
 *     path="/api/streamer/group",
 *     tags={"Group Pages"},
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
 *      description="For Home Data as ['group']")
 * )
 */
/**
 * @OA\Post(
 *   path="/api/streamer/create_group",
 *   summary="Add New Group",
 *   tags={"Group Pages"},
 *   security={{"bearerAuth":{}}},
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       required={"title","slug","description", "academic_year","subject","start","end"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="First Exam",
 *         description="required|string|max:255"
 *       ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         example="<h1>Description</h1>",
 *         description="required|integer"
 *       ),
 *     @OA\Property(
 *         property="start",
 *         type="string",
 *         example="2020-05-04",
 *         description="required|string"
 *       )
 * ,
 *     @OA\Property(
 *         property="end",
 *         type="string",
 *         example="2020-08-04",
 *         description="required|string"
 *       )
 * ,
 *     @OA\Property(
 *         property="academic_year",
 *         type="string",
 *         example="the-second-primary-grade",
 *         description="required|integer"
 *       ),
 * 
 *     @OA\Property(
 *         property="subject",
 *         type="string",
 *         example="psychology",
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
/**
 * @OA\Get(
 *     operationId="Group Get Data Details",
 *     path="/api/streamer/group/{slug}",
 *     tags={"Group Pages"},
 *     security={{"bearerAuth":{}}},
 *  @OA\Parameter(
 *      name="slug",
 *      description="Group Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *     @OA\Response(
 *     response="200",
 *      description="For Home Data as ['groups']")
 * )
 */
/**
 * @OA\Put(
 *   path="/api/streamer/group/{slug}",
 *   summary="Update Group",
 *   tags={"Group Pages"},
 *   security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *      name="slug",
 *      description="Group Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       required={"name","phone","email"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="First Exam",
 *         description="required|string|max:255"
 *       ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         example="<h1>Description</h1>",
 *         description="required|integer"
 *       ),
 *     @OA\Property(
 *         property="start",
 *         type="string",
 *         example="2020-05-04",
 *         description="required|string"
 *       )
 * ,
 *     @OA\Property(
 *         property="end",
 *         type="string",
 *         example="2020-08-04",
 *         description="required|string"
 *       )
 * ,
 *     @OA\Property(
 *         property="academic_year",
 *         type="string",
 *         example="the-second-primary-grade",
 *         description="required"
 *       ),
 *
 *     @OA\Property(
 *         property="subject",
 *         type="string",
 *         example="psychology",
 *         description="required"
 *       )
 *     )
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Success",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="{user{data}",
 *         type="string",
 *         description="User"
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
/**
 * @OA\Delete(
 *   path="/api/streamer/group/{slug}",
 *   summary="Delete Group",
 *   tags={"Group Pages"},
 *   security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *      name="slug",
 *      description="Group Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *     )
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Success",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="{user{data}",
 *         type="string",
 *         description="User"
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
//===========================End=Group=============================================
//===========================Start=Lesson=============================================
/**
 * @OA\Get(
 *     operationId="Lesson",
 *     path="/api/streamer/{group}/lesson",
 *     tags={"Lesson Pages"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *      name="group",
 *      description="Group Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *    @OA\Parameter(
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
 *      description="For Home Data as ['Lesson']")
 * )
 */
/**
 * @OA\Post(
 *   path="/api/streamer/{group}/create_lesson",
 *   summary="Add New Lesson",
 *   tags={"Lesson Pages"},
 *   security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *      name="group",
 *      description="Group Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       required={"title","slug","description","start","end"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="First Lesson",
 *         description="required|string|max:255"
 *       ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         example="<h1>Description</h1>",
 *         description="required|integer"
 *       ),
 *     @OA\Property(
 *         property="start",
 *         type="string",
 *         example="2020-05-04",
 *         description="required|string"
 *       )
 * ,
 *     @OA\Property(
 *         property="end",
 *         type="string",
 *         example="2020-08-04",
 *         description="required|string"
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
/**
 * @OA\Get(
 *     operationId="Lesson Get Data Details",
 *     path="/api/streamer/lesson/{lesson}",
 *     tags={"Lesson Pages"},
 *     security={{"bearerAuth":{}}},
 *  @OA\Parameter(
 *      name="lesson",
 *      description="lesson Slug",
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
/**
 * @OA\Put(
 *   path="/api/streamer/lesson/{lesson}",
 *   summary="Update Lesson",
 *   tags={"Lesson Pages"},
 *   security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *      name="lesson",
 *      description="Lesson Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       required={"title","slug","description","start","end"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="Second Lesson",
 *         description="required|string|max:255"
 *       ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         example="<h1>Description</h1>",
 *         description="required|integer"
 *       ),
 *     @OA\Property(
 *         property="start",
 *         type="string",
 *         example="2020-05-04",
 *         description="required|string"
 *       )
 * ,
 *     @OA\Property(
 *         property="end",
 *         type="string",
 *         example="2020-08-04",
 *         description="required|string"
 *       )
 *     )
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Success",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="{user{data}",
 *         type="string",
 *         description="User"
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
/**
 * @OA\Delete(
 *   path="/api/streamer/lesson/{lesson}",
 *   summary="Delete Lesson",
 *   tags={"Lesson Pages"},
 *   security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *      name="lesson",
 *      description="Lesson Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *     )
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Success",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="{user{data}",
 *         type="string",
 *         description="User"
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
////===========================End=Lesson=============================================
//===========================Start=governorate==========================================
/**
 * @OA\Get(
 *     operationId="All Governorates Of Egypt",
 *     path="/api/governorate",
 *     tags={"Governorates"},
 *     @OA\Parameter(
 *         name="lang",
 *         in="query",
 *         required=true,
 *         description="Lang",
 *         @OA\Schema(
 *              type="string",
 *              example="ar",
 *         )
 *      ),
 *     @OA\Response(
 *     response="200",
 *      description="For Home Data as ['governorates']")
 * )
 */
//===========================End=governorate=============================================
//===========================Start=Quiz=============================================
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
        /**
     * @OA\Get(
     *     operationId="Quiz Get Data Details",
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
        /**
 * @OA\Put(
 *   path="/api/streamer/quiz/{slug}",
 *   summary="Update Quiz",
 *   tags={"quiz Pages"},
 *   security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *      name="slug",
 *      description="Quiz Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       required={"name","phone","email"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="New Exam",
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
 *         property="{user{data}",
 *         type="string",
 *         description="User"
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
        /**
 * @OA\Delete(
 *   path="/api/streamer/quiz/{slug}",
 *   summary="Delete Quiz",
 *   tags={"quiz Pages"},
 *   security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *      name="slug",
 *      description="Quiz Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *     )
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Success",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="{user{data}",
 *         type="string",
 *         description="User"
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
//===========================End=Quiz=============================================
//===========================Start=Question=============================================
        /**
     * @OA\Get(
     *     operationId="Question",
     *     path="/api/streamer/{quiz}/question",
     *     tags={"question Pages"},
     *     security={{"bearerAuth":{}}},
     *     @OA\Parameter(
     *      name="quiz",
     *      description="Quiz Slug",
     *      required=true,
     *      in="path",
     *      @OA\Schema(
     *          type="string"
     *      )
     *   ),
     *    @OA\Parameter(
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
     *      description="For Home Data as ['question']")
     * )
     */
        /**
 * @OA\Post(
 *   path="/api/streamer/{quiz}/create_question",
 *   summary="Add New Question",
 *   tags={"question Pages"},
 *   security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *      name="quiz",
 *      description="Quiz Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       required={"title"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="First Question",
 *         description="required|string|max:255"
 *       ),
 *     @OA\Property(
 *         property="answers",
 *         type="string",
 *         example="[{'title':'First Answer','type':0},{'title':'Second Answer','type':1},{'title':'Third Answer','type':0}]",
 *         description="required|string|max:255"
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
        /**
 * @OA\Get(
 *     operationId="Question Get Data Details",
 *     path="/api/streamer/question/{question}",
 *     tags={"question Pages"},
 *     security={{"bearerAuth":{}}},
 *  @OA\Parameter(
 *      name="question",
 *      description="question Slug",
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
        /**
 * @OA\Put(
 *   path="/api/streamer/question/{question}",
 *   summary="Update Question",
 *   tags={"question Pages"},
 *   security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *      name="question",
 *      description="Question Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *      )
 *   ),
 *   @OA\RequestBody(
 *     required=true,
 *     @OA\JsonContent(
 *       type="object",
 *       required={"title","answers"},
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="updated Question",
 *         description="required|string|max:255"
 *       ),
 *     @OA\Property(
 *         property="answers",
 *         type="string",
 *         example="[{'title':'First Answer Updated','type':0},{'title':'Second Answer Updated','type':1},{'title':'Third Answer Updated','type':0}]",
 *         description="required|string"
 *       )
 *     )
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Success",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="{user{data}",
 *         type="string",
 *         description="User"
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
        /**
 * @OA\Delete(
 *   path="/api/streamer/question/{question}",
 *   summary="Delete Question",
 *   tags={"question Pages"},
 *   security={{"bearerAuth":{}}},
 *     @OA\Parameter(
 *      name="question",
 *      description="Question Slug",
 *      required=true,
 *      in="path",
 *      @OA\Schema(
 *          type="string"
 *     )
 *   ),
 *   @OA\Response(
 *     response=201,
 *     description="Success",
 *     @OA\JsonContent(
 *       type="object",
 *       @OA\Property(
 *         property="{user{data}",
 *         type="string",
 *         description="User"
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
////===========================End=Question=============================================
//============================End==Streamer=============================================
class ApiController extends Controller
{

}
