<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\Register\RegisterRequest;
use App\Http\Resources\User\UserResource;
use App\Repository\Dto\UserDto;
use App\Repository\UserRepository;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

/**
 * Class ApiRegisterController
 * @package App\Http\Controllers\Api\Auth
 */
class ApiRegisterController
{
    /**
     * @var UserRepository
     */
    private UserRepository $user;


    /**
     * ApiRegisterController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }


    /**
     * @param RegisterRequest $request
     * @return UserResource
     * @throws Exception
     */
    public function register(RegisterRequest $request): UserResource
    {
        return new UserResource($this->user->store(new UserDto($request->all())));
    }


    /**
     * @param $key
     * @return Factory|View|void
     */
    public function confirm($key)
    {
        $user = $this->user->getByConfirmKey($key);

        if ($user) {
            $user->update([
                'confirm_key' => null,
                'confirm'     => true,
                'role_type'   => 'client',
            ]);

            return view('auth.confirm');
        }

        return abort(404);
    }
}
