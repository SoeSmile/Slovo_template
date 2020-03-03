<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Requests\User\UserApproveRequest;
use App\Http\Requests\User\UserIndexRequest;
use App\Http\Requests\User\UserShowRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Repository\Dto\UserDto;
use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ApiUsersController
 * @package App\Http\Controllers\Api
 */
class ApiUsersController
{
    /**
     * @var UserRepository
     */
    private UserRepository $user;


    /**
     * ApiUsersController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }


    /**
     * @param UserIndexRequest $request
     * @return AnonymousResourceCollection
     */
    public function index(UserIndexRequest $request): AnonymousResourceCollection
    {
        return UserResource::collection($this->user->all($request->all()));
    }


    /**
     * @param $id
     * @param UserShowRequest $request
     * @return UserResource
     */
    public function show($id, UserShowRequest $request): UserResource
    {
        return new UserResource($this->user->get($id));
    }


    /**
     * @param UserStoreRequest $request
     * @return UserResource
     */
    public function store(UserStoreRequest $request): UserResource
    {
        return new UserResource($this->user->store(new UserDto($request->all())));
    }


    /**
     * @param $id
     * @param UserUpdateRequest $request
     * @return JsonResponse
     */
    public function update($id, UserUpdateRequest $request): JsonResponse
    {
        $result = $this->user->update($id, new UserDto($request->all()));

        return response()->json(['success' => (bool)$result], $result ? 200 : 400);
    }


    /**
     * @param UserApproveRequest $request
     * @return JsonResponse
     */
    public function approve(UserApproveRequest $request): JsonResponse
    {
        $result = $this->user->approve($request->ids);

        return response()->json(['success' => (bool)$result], $result ? 200 : 400);
    }
}
