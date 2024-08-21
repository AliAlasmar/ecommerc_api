<?php

namespace App\Traits;
use App\Models\Token;
use App\Models\User;

trait ApiResponseTrait
{
    public function success($data, $message = 'Success')
    {
        return response()->json(['status' => true, 'message' => $message, 'data' => $data]);
    }

    public function error($message = 'Error', $statusCode = 400)
    {
        return response()->json(['status' => false, 'message' => $message], $statusCode);
    }

    public function is_login($request)
    {
        try {
            // تحقق من وجود التوكن في الهيدر
            if (!$token = $request->bearerToken()) {
                return $this->error('No token provided', 401);
            }

            // تحقق من التوكن في قاعدة البيانات
            $tokenRecord = Token::where('token', $token)->first();

            if (!$tokenRecord) {
                return $this->error('Invalid token', 401);
            }

            // احصل على المستخدم المرتبط بالتوكن
            $user = User::find($tokenRecord->user_id);

            if (!$user) {
                return $this->error('User not found', 404);
            }

            // إرجاع معلومات المستخدم إذا كان التوكن صحيح
            return $this->success(['user' => $user], 'User is authenticated');

        } catch (\Exception $e) {
            // معالجة أي خطأ آخر
            return $this->error('An error occurred', 500);
        }
    }
}
