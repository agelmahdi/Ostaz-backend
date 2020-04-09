<?php

namespace App\Http\Controllers\Auth;

use App\Streamer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Config;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;
class ApiAuthStreamerController extends Controller
{
    function __construct()
    {
        Config::set('jwt.user', Streamer::class);
        Config::set('auth.providers', ['users' => [
            'driver' => 'eloquent',
            'model' => Streamer::class,
        ]]);
    }
    /**
     * @OA\Post(
     *   path="/api/streamer/login",
     *   summary="User Login",
     *   tags={"Streamer Authorization"},
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
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 401);
        }
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'These credentials do not match our records.'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }
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
     *         example="user@user.com",
     *         description="required|string|email|max:255|unique:users"
     *       ),
     *       @OA\Property(
     *         property="password",
     *         type="string",
     *         example="123123",
     *         description="required|string|min:6|confirmed"
     *       ),
     *     @OA\Property(
     *         property="password_confirmation",
     *         type="string",
     *         example="123123",
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
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => ['required', 'unique:followers'],
            'address' => 'string|max:255',
            'gender' => 'string|max:20',
            'birthday' => 'string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $filename = time() . ".jpg";
        $date = date('FY');
        if ($request->file('avatar')) {
            $path = $request->file('avatar')->move(storage_path('app/public/users/' . $date), $filename);
            $photoUrl = '/follower/' . $date . '/' . $filename;

        } else {
            $photoUrl = "/follower/default.jpg";
        }

        $user = Follower::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'birthday' => $request->get('gender'),
            'image' => $photoUrl,
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }
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

    public function updateProfilePassword(Request $request)
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

        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string|max:255',
            'new_password' => 'required|string|min:6|confirmed'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if (!(Hash::check($request->get('current_password'), $user->password))) {
            return response()->json(['error' => 'password not Valid'], 400);
        }
        $user->update([
            'password' => bcrypt($request->get('new_password')),
        ]);
        $user->save();
        $user = [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'address' => $user->address,
            'gender' => $user->gender,
            'birthday' => $user->birthday,
            'email' => $user->email,
            'image' => env('APP_URL') . '/' . $user->avatar,

        ];
        return response()->json(compact('user'), 201);
    }

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
    public function updateProfile(Request $request)
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone' => ['required', 'unique:users,phone,' . $user->id],
            'address' => 'string|max:255',
            'gender' => 'string|max:20',
            'birthday' => 'string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $user->update([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'birthday' => $request->get('birthday'),
            'email' => $request->get('email')
        ]);
        $user->save();
        $user = [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'address' => $user->address,
            'birthday' => $user->birthday,
            'email' => $user->email,
            'avatar' => env('APP_URL') . '/storage/' . $user->avatar,
        ];
        return response()->json(compact('user'), 201);
    }

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
    public function updateProfileImage(Request $request)
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

        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $filename = time() . ".jpg";
        $date = date('FY');
        if ($request->file('avatar')) {
            $path = $request->file('avatar')->move(storage_path('follower/' . $date), $filename);
            $photoUrl = '/follower/' . $date . '/' . $filename;

        } else {
            $photoUrl = "/follower/default.jpg";
        }

        $user->update([
            'image' => $photoUrl,
        ]);
        $user->save();
        $user = [
            'id' => $user->id,
            'first_name' => $user->name,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'address' => $user->address,
            'birthday' => $user->birthday,
            'email' => $user->email,
            'image' => env('APP_URL') . '/follower/' . $user->avatar,
        ];
        return response()->json(compact('user'), 201);
    }
    /**
     * @OA\Get(
     *   path="/api/streamer/me",
     *   summary="User Data",
     *   tags={"Streamer Authorization"},
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
    public function getAuthenticatedUser()
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

        $user = [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $user->phone,
            'gender' => $user->gender,
            'address' => $user->address,
            'birthday' => $user->birthday,
            'email' => $user->email,
            'avatar' => env('APP_URL') . $user->avatar,
        ];
        return response()->json(compact('user'));
    }

}
