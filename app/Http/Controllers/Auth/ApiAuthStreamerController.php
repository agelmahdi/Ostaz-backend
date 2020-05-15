<?php

namespace App\Http\Controllers\Auth;

use App\AcademicYear;
use App\Follower;
use App\Streamer;
use App\Subject;
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
        $user=User::where('email',$request->get('email'))->first();
        if($user->role==1){
            $streamer=Streamer::where('email',$user->email)->first();
            $user = [
                'name_ar' => $streamer->name_ar,
                'name_en' => $streamer->name_en,
                'slug_ar' => $streamer->slug_ar,
                'slug_en' => $streamer->slug_en,
                'phone' => $streamer->phone,
                'gender' => $streamer->gender,
                'address_ar' => $streamer->address_ar,
                'address_en' => $streamer->address_en,
                'email' => $streamer->email,
                'image' => env('APP_URL') . $streamer->image,
                'is_streamer'=>true,
            ];
        }
        elseif($user->role==2){
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
        }
        return response()->json(compact(['token','user']));
    }
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'slug_ar' => 'required|string|max:255',
            'slug_en' => 'required|string|max:255',
            'phone' => ['required', 'unique:streamers'],
            'address_ar' => 'string|max:255',
            'address_en' => 'string|max:255',
            'city_id' => 'integer|max:255',
            'subjects' => 'required|max:500',
            'academic_years' => 'required|max:500',
            'gender' => 'string|max:20',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $subjects = json_decode(str_replace("'", '"', $request->get('subjects')), true);
        if ($subjects == null) {
            return response()->json(['sorry your subjects not write Correctly'], 400);
        }
        if (count($subjects) == 0) {
            return response()->json(['The Array must contain data'], 400);
        }
        $count = 0;
        $subjects_arr = [];
        foreach ($subjects as $subject) {

            $subject = Subject::where(function ($query) use ($subject) {
                $query->where('slug_ar', $subject);
                $query->orwhere('slug_en', $subject);
            })->first();
            if ($subject != null) {
                $subjects_arr[$count] = $subject->id;
                $count++;
            }
        }
        $academic_years = json_decode(str_replace("'", '"', $request->get('academic_years')), true);
        if ($academic_years == null) {
            return response()->json(['sorry your academic_years not write Correctly'], 400);
        }
        if (count($academic_years) == 0) {
            return response()->json(['The Array must contain data'], 400);
        }
        $count = 0;
        $academic_arr = [];
        foreach ($academic_years as $academic_year) {
            $academic = AcademicYear::where(function ($query) use ($academic_year) {
                $query->where('slug_ar', $academic_year);
                $query->orwhere('slug_en', $academic_year);
            })->first();
            if ($academic != null) {
                $academic_arr[$count] = $academic->id;
                $count++;
            }
        }
        $filename = time() . ".jpg";
        $date = date('FY');
        if ($request->file('image')) {
            $path = $request->file('image')->move(storage_path('app/public/streamer/' . $date), $filename);
            $photoUrl = '/streamer/' . $date . '/' . $filename;

        } else {
            $photoUrl = "/streamer/default.jpg";
        }

        $streamer = Streamer::create([
            'name_ar' => $request->get('name_ar'),
            'name_en' => $request->get('name_en'),
            'slug_ar' => $request->get('slug_ar'),
            'slug_en' => $request->get('slug_en'),
            'phone' => $request->get('phone'),
            'address_ar' => $request->get('address_ar'),
            'address_en' => $request->get('address_en'),
            'city_id' => $request->get('city_id'),
            'gender' => $request->get('gender'),
            'image' => $photoUrl,
            'email' => $request->get('email')
        ]);
        $user = User::create([
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role'=>1,
            'role_id'=>$streamer->id,
        ]);
        $streamer->Subjects()->sync($subjects_arr);
        $streamer->AcademicYears()->sync($academic_arr);
//        $token = JWTAuth::fromUser($user);

        return response()->json("Success", 201);
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
        if($user->role!=1){
            return response()->json('sorry this user role is not As Streamer',402);
        }
        if (!(Hash::check($request->get('current_password'), $user->password))) {
            return response()->json(['error' => 'password not Valid'], 400);
        }
        $user->update([
            'password' => bcrypt($request->get('new_password')),
        ]);
        $user->save();
        $streamer=Streamer::where('email',$user->email)->first();
        $user = [
            'name_ar' => $streamer->name_ar,
            'name_en' => $streamer->name_en,
            'slug_ar' => $streamer->slug_ar,
            'slug_en' => $streamer->slug_en,
            'phone' => $streamer->phone,
            'gender' => $streamer->gender,
            'address_ar' => $streamer->address_ar,
            'address_en' => $streamer->address_en,
            'email' => $streamer->email,
            'image' => env('APP_URL') . $streamer->image,
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
            'name_ar' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'slug_ar' => 'required|string|max:255',
            'slug_en' => 'required|string|max:255',
            'phone' => ['required', 'unique:streamers,phone,' . $user->role_id],
            'address_ar' => 'string|max:255',
            'address_en' => 'string|max:255',
            'gender' => 'string|max:20',
            'birthday' => 'string|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        if($user->role!=1){
            return response()->json('sorry this user role is not As Streamer',402);
        }
        $streamer=Streamer::where('email',$user->email)->first();
        $streamer->update([
            'name_ar' => $request->get('name_ar'),
            'name_en' => $request->get('name_en'),
            'slug_ar' => $request->get('slug_ar'),
            'slug_en' => $request->get('slug_en'),
            'phone' => $request->get('phone'),
            'address_ar' => $request->get('address_ar'),
            'address_en' => $request->get('address_en'),
            'gender' => $request->get('gender'),
            'birthday' => $request->get('birthday'),
            'email' => $request->get('email')
        ]);
        $streamer->save();
        $user->update([
            'email' => $request->get('email')
        ]);
        $user = [
            'name_ar' => $streamer->name_ar,
            'name_en' => $streamer->name_en,
            'slug_ar' => $streamer->slug_ar,
            'slug_en' => $streamer->slug_en,
            'phone' => $streamer->phone,
            'gender' => $streamer->gender,
            'address_ar' => $streamer->address_ar,
            'address_en' => $streamer->address_en,
            'email' => $streamer->email,
            'image' => env('APP_URL') . $streamer->image,
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
        if($user->role!=1){
            return response()->json('sorry this user role is not As Streamer',402);
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
            $path = $request->file('image')->move(storage_path('streamer/' . $date), $filename);
            $photoUrl = '/streamer/' . $date . '/' . $filename;

        } else {
            $photoUrl = "/streamer/default.jpg";
        }
        $streamer=Streamer::where('email',$user->email)->first();
        $streamer->update([
            'image' => $photoUrl,
        ]);
        $streamer->save();
        $user = [
            'name_ar' => $streamer->name_ar,
            'name_en' => $streamer->name_en,
            'slug_ar' => $streamer->slug_ar,
            'slug_en' => $streamer->slug_en,
            'phone' => $streamer->phone,
            'gender' => $streamer->gender,
            'address_ar' => $streamer->address_ar,
            'address_en' => $streamer->address_en,
            'email' => $streamer->email,
            'image' => env('APP_URL') . $streamer->image,
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
        if($user->role==1){
            $streamer=Streamer::where('email',$user->email)->first();
            $user = [
                'name_ar' => $streamer->name_ar,
                'name_en' => $streamer->name_en,
                'slug_ar' => $streamer->slug_ar,
                'slug_en' => $streamer->slug_en,
                'phone' => $streamer->phone,
                'gender' => $streamer->gender,
                'address_ar' => $streamer->address_ar,
                'address_en' => $streamer->address_en,
                'email' => $streamer->email,
                'image' => env('APP_URL') . $streamer->image,
                'is_streamer'=>true,
            ];
        }
        elseif($user->role==2){
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
        }
        return response()->json(compact('user'));
    }
    public function followers_register(Request $request)
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
            'name' => 'required|string|max:255',
            'phone' => ['required', 'unique:followers'],
            'address' => 'string|max:255',
            'gender' => 'string|max:20',
            'birthday' => 'string|max:255',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'academic_year' => 'required|max:500',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $filename = time() . ".jpg";
        $date = date('FY');
        if ($request->file('image')) {
            $path = $request->file('image')->move(storage_path('app/public/followers/' . $date), $filename);
            $photoUrl = '/followers/' . $date . '/' . $filename;

        } else {
            $photoUrl = "/followers/default.jpg";
        }
        $academic_year=$request->get('academic_year');
        $academic = AcademicYear::where(function ($query) use ($academic_year) {
            $query->where('slug_ar', $academic_year);
            $query->orwhere('slug_en', $academic_year);
        })->first();
        if($academic==null){
            return response()->json(['sorry your data not equal our system'], 400);
        }
        $follower = Follower::create([
            'name' => $request->get('name'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
            'gender' => $request->get('gender'),
            'birthday' => $request->get('gender'),
            'image' => $photoUrl,
            'email' => $request->get('email'),
            'academic_year_id' =>$academic->id ,
        ]);
         User::create([
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'role' => 2,
            'role_id' => $follower->id,
        ]);
        $arr[0]=$user->role_id;
        $follower->Streamers()->attach($arr);

        return response()->json("Success", 201);
    }
}
