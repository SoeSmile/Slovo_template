<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Resources\Role\RoleResource;
use App\Repository\Dto\RoleDto;
use App\Repository\RoleRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Class ApiRoleController
 * @package App\Http\Controllers\Api
 */
class ApiRoleController
{
    /**
     * @var RoleRepository
     */
    private RoleRepository $role;


    /**
     * ApiRoleController constructor.
     * @param RoleRepository $roleRepository
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->role = $roleRepository;
    }


    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        return RoleResource::collection($this->role->all($request->all()));
    }
}
