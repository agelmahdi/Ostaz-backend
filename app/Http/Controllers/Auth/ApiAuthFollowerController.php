<?php

namespace App\Http\Controllers\Auth;

use App\Follower;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Config;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Controllers\Controller;

class ApiAuthFollowerController extends Controller
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
        if ($request->file('image')) {
            $path = $request->file('image')->move(storage_path('app/public/users/' . $date), $filename);
            $photoUrl = '/follower/' . $date . '/' . $filename;

        } else {
            $photoUrl = "/follower/default.jpg";
        }

        $follower = Follower::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'birthday' => $request->get('gender'),
            'image' => $photoUrl,
            'email' => $request->get('email'),
        ]);
        $user = User::create([
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => 2,
            'role_id' => $follower->id,
        ]);
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('follower', 'token'), 201);
    }

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
        if ($user->role != 2) {
            return response()->json('sorry this user role is not As Follower', 402);
        }
        if (!(Hash::check($request->get('current_password'), $user->password))) {
            return response()->json(['error' => 'password not Valid'], 400);
        }
        $user->update([
            'password' => bcrypt($request->get('new_password')),
        ]);
        $user->save();
        $follower = Follower::where('email', $user->email)->first();
        $user = [
            'id' => $follower->id,
            'name' => $follower->name,
            'phone' => $follower->phone,
            'address' => $follower->address,
            'gender' => $follower->gender,
            'birthday' => $follower->birthday,
            'email' => $follower->email,
            'image' => env('APP_URL') . '/' . $follower->image,

        ];
        return response()->json(compact('user'), 201);
    }

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
            'phone' => ['required', 'unique:followers,phone,' . $user->role_id],
            'address' => 'string|max:255',
            'gender' => 'string|max:20',
            'birthday' => 'string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);
        if ($user->role != 2) {
            return response()->json('sorry this user role is not As Follower', 402);
        }
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $follower = Follower::where('email', $user->email)->first();
        $follower->update([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'birthday' => $request->get('birthday'),
            'email' => $request->get('email')
        ]);
        $follower->save();
        $user->update([
            'email' => $request->get('email')
        ]);
        $user = [
            'id' => $follower->id,
            'name' => $follower->name,
            'phone' => $follower->phone,
            'gender' => $follower->gender,
            'address' => $follower->address,
            'birthday' => $follower->birthday,
            'email' => $follower->email,
            'image' => env('APP_URL') . '/storage/' . $follower->image,
        ];
        return response()->json(compact('user'), 201);
    }

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
        if ($user->role != 2) {
            return response()->json('sorry this user role is not As Follower', 402);
        }
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $filename = time() . ".jpg";
        $date = date('FY');
        if ($request->file('image')) {
            $path = $request->file('image')->move(storage_path('follower/' . $date), $filename);
            $photoUrl = '/follower/' . $date . '/' . $filename;

        } else {
            $photoUrl = "/follower/default.jpg";
        }
        $follower = Follower::where('email', $user->email)->first();
        $follower->update([
            'image' => $photoUrl,
        ]);
        $follower->save();
        $user = [
            'name' => $follower->name,
            'phone' => $follower->phone,
            'gender' => $follower->gender,
            'address' => $follower->address,
            'birthday' => $follower->birthday,
            'email' => $follower->email,
            'image' => env('APP_URL') . '/follower/' . $follower->image,
        ];
        return response()->json(compact('user'), 201);
    }

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
        if ($user->role != 2) {
            return response()->json('sorry this user role is not As Follower', 402);
        }
        $follower = Follower::where('email', $user->email)->first();
        $user = [
            'name' => $follower->name,
            'phone' => $follower->phone,
            'gender' => $follower->gender,
            'address' => $follower->address,
            'birthday' => $follower->birthday,
            'email' => $follower->email,
            'avatar' => env('APP_URL') . $follower->image,
            'is_streamer'=>false,
        ];
        return response()->json(compact('user'));
    }

}
