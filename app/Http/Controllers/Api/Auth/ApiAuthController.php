<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\JsonResponse;

/**
 * Class ApiAuthController
 * @package App\Http\Controllers\Api\Auth
 */
class ApiAuthController
{
    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!$token = auth()->attempt($request->all())) {

            return response()->json([
                'errors' =>
                    [
                        'auth' => trans('auth.failed')
                    ]
            ], 401);
        }

        return $this->respondWithToken($token);
    }


    /**
     * @return UserResource
     */
    public function me(): UserResource
    {
        return new UserResource(auth()->user());
    }


    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }


    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     * @param $token
     * @return JsonResponse
     */
    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'token'     => $token,
            'expiresIn' => auth()->factory()->getTTL() * 60,
            'user'      => new UserResource(auth()->user()),
        ]);
    }
}