<?php

namespace App\Http\Controllers;

use App\Models\Token;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponseTrait;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use JWTAuth;

class AuthController extends Controller
{
    use ApiResponseTrait;

    /**
     * @OA\Post(
     *     path="/api/register",
     *     summary="Register a new user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="John Doe"),
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User registered successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="User registered successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation Error",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="The email has already been taken."),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */

    public function register(RegisterRequest  $request)
    {
        try {
            // تحقق من المدخلات
            $validatedData = $request->validated();
            // إنشاء مستخدم جديد
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);


            // إنشاء توكن JWT للمستخدم الجديد
            $token = JWTAuth::fromUser($user);
            $inserToken = Token::create([
                'user_id'=> $user->id,
                'token'=> $token
            ]);


            return $this->success(['token' => $token], 'User registered successfully');
        } catch (ValidationException $e) {
            // في حال فشل التحقق من البيانات
            return $this->error($e->errors(), 422);
        } catch (\Exception $e) {
            // معالجة أي خطأ آخر
            return $e;
            //return $this->error('An error occurred during registration', 500);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     summary="Login user",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User logged in successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="User logged in successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9..."),
     *                 @OA\Property(property="user", type="object",
     *                     @OA\Property(property="id", type="integer", example=1),
     *                     @OA\Property(property="name", type="string", example="John Doe"),
     *                     @OA\Property(property="email", type="string", example="john.doe@example.com")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Invalid credentials",
     *         @OA\JsonContent(
     *             @OA\Property(property="status", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Invalid credentials"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     )
     * )
     */


    public function login(LoginRequest $request)
    {
        try {
            // التحقق من المدخلات
            $validatedData = $request->validated();

            $credentials = $request->only('email', 'password');

            // محاولة تسجيل الدخول
            if (!$token = auth()->attempt($credentials)) {
                return $this->error('Invalid credentials', 401);
            }

            // الحصول على المستخدم
            $user = User::where('email', $request->email)->first();

            // حذف التوكنات القديمة إذا كانت موجودة
            Token::where('user_id', $user->id)->delete();

            // إنشاء توكن جديد
            $newToken = JWTAuth::fromUser($user);

            // تخزين التوكن الجديد في قاعدة البيانات
            Token::create([
                'user_id' => $user->id,
                'token' => $newToken
            ]);

            // إرجاع التوكن الجديد
            return response()->json([
                'status' => true,
                'message' => 'User logged in successfully',
                'data' => [
                    'token' => $newToken,
                    'user' => $user
                ]
            ]);
        } catch (ValidationException $e) {
            return $this->error($e->errors(), 422);
        } catch (\Exception $e) {
            return $this->error('An error occurred during login', 500);
        }
    }



//    public function is_login(Request $request)
//    {
//        try {
//            // تحقق من وجود التوكن في الهيدر
//            if (!$token = $request->bearerToken()) {
//                return response()->json([
//                    'status' => false,
//                    'message' => 'No token provided',
//                ], 401);
//            }
//
//            // تحقق من التوكن في قاعدة البيانات
//            $tokenRecord = Token::where('token', $token)->first();
//
//            if (!$tokenRecord) {
//                return response()->json([
//                    'status' => false,
//                    'message' => 'Invalid token',
//                ], 401);
//            }
//
//            // احصل على المستخدم المرتبط بالتوكن
//            $user = User::find($tokenRecord->user_id);
//
//            if (!$user) {
//                return response()->json([
//                    'status' => false,
//                    'message' => 'User not found',
//                ], 404);
//            }
//
//            // إرجاع معلومات المستخدم إذا كان التوكن صحيح
//            return response()->json([
//                'status' => true,
//                'message' => 'User is authenticated',
//                'data' => [
//                    'user' => $user
//                ]
//            ]);
//
//        } catch (\Exception $e) {
//            // معالجة أي خطأ آخر
//            return response()->json([
//                'status' => false,
//                'message' => 'An error occurred',
//            ], 500);
//        }
//    }



}
