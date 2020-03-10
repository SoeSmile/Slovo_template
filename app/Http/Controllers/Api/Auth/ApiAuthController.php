<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Repository\Dto\JournalDto;
use App\Repository\JournalRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class ApiAuthController
 * @package App\Http\Controllers\Api\Auth
 */
class ApiAuthController
{
    /**
     * @var JournalRepository
     */
    private JournalRepository $journal;


    /**
     * ApiAuthController constructor.
     * @param JournalRepository $journalRepository
     */
    public function __construct(JournalRepository $journalRepository)
    {
        $this->journal = $journalRepository;
    }


    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!$token = auth()->attempt([
            'email'    => $request->email,
            'password' => $request->password,
            'confirm'  => true
        ])) {
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
    private function respondWithToken($token): JsonResponse
    {
        $this->storeJournalUpdateTz();

        return response()->json([
            'token'     => $token,
            'expiresIn' => auth()->factory()->getTTL() * 60,
            'user'      => new UserResource(auth()->user()),
        ]);
    }


    /**
     * @return void
     */
    private function storeJournalUpdateTz(): void
    {
        $this->journal->store(new JournalDto([
            'user_id' => auth()->id(),
            'event'   => 'userLogin'
        ]));

        if (request()->has('timeZone')) {
            auth()->user()->update(['time_zone' => request()->timeZone]);
        }
    }
}
